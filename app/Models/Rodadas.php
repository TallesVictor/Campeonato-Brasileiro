<?php

namespace App\Models;

use App\Http\Controllers\PosicaoTimeController;
use App\Http\Controllers\TimesController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Rodadas extends Model
{
    use HasFactory;

    protected $table = 'rodadas';
    protected $fillable = ['id', 'time_casa', 'time_fora', 'gols_time_casa', 'gols_time_fora', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    /** Criar rodadas */
    public function create(Request $request)
    {
        // Validar dados recebidos via AJAX
        $validator = Validator::make(
            $request->all(),
            [
                'timeCasa' => 'required|numeric',
                'timeVisitante'      => 'required|numeric',
                'placarCasa'     => 'required|numeric',
                'placarVisitante'      => 'required|numeric',
            ]
        );

        if ($validator->fails()) {
            $erro = (object)[];
            $erro->erro = $validator->errors();
            return response()
                ->json($erro);
        }
        
        $timeCasa = intval($request->timeCasa);
        $timeVisitante = intval($request->timeVisitante);

        if($timeCasa == $timeVisitante){
            return response("Dois times iguais não podem disputar!", 400);
        }

        $quantidadeJogos = self::quantidadeJogos($timeCasa);
        $quantidadeJogos .= self::quantidadeJogos(intval($timeVisitante));

        if (!$quantidadeJogos) {

            $rodadas = new Rodadas();
            $rodadas->time_casa = $timeCasa;
            $rodadas->time_fora = $timeVisitante;
            $rodadas->gols_time_casa = $request->placarCasa;
            $rodadas->gols_time_fora = $request->placarVisitante;
            $rodadas->created_at =  date('Y-m-d H:m:s');
            $rodadas->updated_at = date('Y-m-d H:m:s');
            $rodadas->save();

            return self::updateStatusClassificacao();
        } else {
            return response($quantidadeJogos, 400);
        }
    }

    /** -Alterar posição do time caso necessário & O status dos times, para 1, 0 ou -1. */
    private static function updateStatusClassificacao()
    {

        $posicaoTimeController = new PosicaoTimeController();

        $rankAntigo = $posicaoTimeController->list();
        $rank = $posicaoTimeController->rank();

        for ($i = 0; $i < 20; $i++) {

            $rankeamento = $rank[$i];
            $posicaoAtual = $rankeamento->RANK;
            $time = $rankeamento->id;

            $object = $rankAntigo[$time - 1];
            $posicaoAntiga = $object->RANK;

            //   Caso a posição seja diferente, altera-lá
            $posicaoTime =  $posicaoTimeController->search($time);


            if ($posicaoAtual != $posicaoAntiga || $posicaoTime->jogos != $rankeamento->jogos) {

                $posicaoTime->posicao =  $posicaoAtual;
                $posicaoTime->jogos = $rankeamento->jogos;
                $posicaoTime->vitorias = $rankeamento->vitorias;
                $posicaoTime->empate = $rankeamento->empate;
                $posicaoTime->derrota = $rankeamento->derrota;
                $posicaoTime->gols_pro = $rankeamento->gols_pro;
                $posicaoTime->gols_contra = $rankeamento->gols_contra;
                $posicaoTime->updated_at =  date('Y-m-d H:m:s');

                // Vefificar posição para efetuar a troca caso necessário
                if ($posicaoAtual > $posicaoAntiga) {
                    $posicaoTime->status = -1;
                } else  if ($posicaoAtual < $posicaoAntiga) {
                    $posicaoTime->status = 1;
                } else {
                    $posicaoTime->status = 0;
                }

                if ($posicaoTimeController->change($posicaoTime) != 1) {
                    return "Erro para salvar alteração do time_id: $time";
                }
            }
        }
        self::verificarClassificacao();
        return 'true';
    }

    /** Contar a quantidade de jogos de cada time. */
    private static function quantidadeJogos(int $id)
    {
        $time = new TimesController();
        $soma = Rodadas::where('time_casa', $id)->orWhere('time_fora', $id)->count();
        if ($soma > 37) {
            return "Time <b>" . $time->search($id)->name . "</b> excedeu as 38 partidas<br>";
        }
        return null;
    }
   
    /** Em caso de J=V=E=D=GP=GC */
    private static function verificarClassificacao()
    {
        $posicaoTimeController = new PosicaoTimeController();
        $cmd = "SELECT
                *
                FROM
                posicao_time pt
                WHERE
                EXISTS (
                    SELECT
                        *
                    FROM
                        posicao_time pt2
                    WHERE
                        pt2.vitorias>0
                        AND pt2.vitorias = pt.vitorias
                        AND pt2.empate = pt.empate
                        AND pt2.derrota = pt.derrota
                        AND pt2.gols_pro = pt.gols_pro
                        AND pt2.gols_contra = pt.gols_contra
                        AND pt2.id != pt.id
                )";
        $cmd = DB::select($cmd);

        if (count($cmd) > 0) {
            
            for ($i = 0; $i < count($cmd); $i++) {
                // echo "\n". $i+1 ." - ".count($cmd);
                if($i+1 == count($cmd)){
                    break;
                }else{
                    $timeAnt = $cmd[$i]->time_id;
                    $timeProx = $cmd[$i+1]->time_id;
                }
                

                $confrontoDireto = self::confrontoDireto($timeAnt,  $timeProx);

                // Se confronto for diferente de 0, quer dizer que não tem confronto direto
                if ($confrontoDireto != 0) {

                    $timeMaisVitoria = $confrontoDireto[0]->id;
                    $timeMenosVitoria = $confrontoDireto[1]->id;

                    $timeMaisVitoria =  $posicaoTimeController->search($timeMaisVitoria);
                    $timeMenosVitoria =  $posicaoTimeController->search($timeMenosVitoria);

                    if ($timeMaisVitoria->posicao > $timeMenosVitoria->posicao) {
                        // Trocar de posicao
                        $posicaoAux = $timeMaisVitoria->posicao;
                        $timeMaisVitoria->posicao = $timeMenosVitoria->posicao;
                        $timeMenosVitoria->posicao = $posicaoAux;
                        
                        // Alterar status
                        $timeMaisVitoria->status = 1;
                        $timeMenosVitoria->status = -1;
                        $timeMaisVitoria->updated_at =  date('Y-m-d H:m:s');
                        $timeMenosVitoria->updated_at =  date('Y-m-d H:m:s');

                        if ($posicaoTimeController->change($timeMaisVitoria) != 1) {
                            return "Erro para salvar alteração do time_id: $timeMaisVitoria->time_id";
                        }

                        if ($posicaoTimeController->change($timeMenosVitoria) != 1) {
                            return "Erro para salvar alteração do time_id: $timeMenosVitoria->time_id";
                        }
                    }
                }
            }
        }
    }

     /** Verificar qual time teve mais vitórias no confronto direto */
    private static function confrontoDireto($timePrincipal, $timeSecundario)
    {
        $cmd = "SELECT
                    SUM(vitoria) AS vitorias,
                        id
                FROM
                    (
                        SELECT
                            t.id,
                            CASE
                                WHEN (
                                    r.time_casa = t.id
                                    AND r.gols_time_casa > r.gols_time_fora
                                )
                                OR (
                                    r.time_fora = t.id
                                    AND r.gols_time_fora > r.gols_time_casa
                                ) THEN 1
                                ELSE 0
                            END AS vitoria
                        FROM
                            times t
                            LEFT JOIN rodadas r ON (
                                t.id = r.time_fora
                                OR t.id = r.time_casa
                            )
                        WHERE t.id IN (?, ?) AND(
                        (r.time_fora = ? AND r.time_casa = ?) OR (r.time_fora = ? AND r.time_casa = ?))
                    ) AS partidas
                GROUP BY id
                ORDER BY SUM(vitoria) DESC";
        $cmd = DB::select($cmd, [$timePrincipal, $timeSecundario, $timePrincipal, $timeSecundario, $timeSecundario, $timePrincipal]);
        if (count($cmd) > 0) {
            return $cmd;
        }
        return 0;
    }
}

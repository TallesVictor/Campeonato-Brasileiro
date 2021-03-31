<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Times extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'logo', 'created_at', 'update_at'];
    protected $table = 'times';

    public function index()
    {

        $cmd = "SELECT
                    @curRank := @curRank + 1 AS RANK,
                    tabela.*
                FROM
                    (
                        SELECT
                            NAME,
                            logo,
                            SUM(vitoria) * 3 + SUM(empate) AS pontuacao,
                            SUM(jogos) AS jogos,
                            SUM(vitoria) AS vitorias,
                            SUM(empate) AS empate,
                            (SUM(jogos) - SUM(vitoria)) AS derrota,
                            SUM(gols_pro) AS gols_pro,
                            SUM(gols_contra) AS gols_contra,
                            SUM(gols_pro) - SUM(gols_contra) AS saldo_gols
                        FROM
                            (
                                SELECT
                                    t.name,
                                    t.logo,
                                    r.id AS rodada_id,
                                    t.id AS TIME,
                                    r.gols_time_casa,
                                    r.gols_time_fora,
                                    CASE
                                        WHEN t.id = r.time_casa
                                        OR t.id = r.time_fora THEN 1
                                        ELSE 0
                                    END AS jogos,
                                    CASE
                                        WHEN r.time_casa = t.id THEN r.gols_time_casa
                                        WHEN r.time_casa != t.id THEN r.gols_time_fora
                                        ELSE 0
                                    END AS gols_pro,
                                    CASE
                                        WHEN r.time_casa = t.id THEN r.gols_time_fora
                                        WHEN r.time_casa != t.id THEN r.gols_time_casa
                                        ELSE 0
                                    END AS gols_contra,
                                    CASE
                                        WHEN r.time_casa = t.id THEN 'C'
                                        ELSE 'F'
                                    END AS local_jogo,
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
                                    END AS vitoria,
                                    CASE
                                        WHEN (
                                            r.time_casa = t.id
                                            AND r.gols_time_casa = r.gols_time_fora
                                        )
                                        OR (
                                            r.time_fora = t.id
                                            AND r.gols_time_fora = r.gols_time_casa
                                        ) THEN 1
                                        ELSE 0
                                    END AS empate
                                FROM
                                    times t
                                    LEFT JOIN rodadas r ON (
                                        t.id = r.time_fora
                                        OR t.id = r.time_casa
                                    )
                            ) AS partidas
                        GROUP BY
                            NAME
                    ) AS tabela,
                    (
                        SELECT
                            @curRank := 0
                    ) r
                ORDER BY
                    pontuacao DESC";

        $cmd = DB::select($cmd);
        return $cmd;
    }

    public function show()
    {
        return Times::all(['id', 'name']);
    }

    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'timeCasa' => 'required|numeric',
                'placarCasa'     => 'required|numeric',
                'placarVisitante'      => 'required|numeric',
                'timeVisitante'      => 'required|numeric',
            ]
        );

        if ($validator->fails()) {
            $erro = (object)[];
            $erro->erro = $validator->errors();
            return response()
                ->json($erro);
        }
        
        $request->created_at = date('Y-m-d');
        $request->updated_at = date('Y-m-d');
        $times = new Times($request->all());
        $times->save();
        return true;
    }
}

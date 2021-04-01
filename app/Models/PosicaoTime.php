<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PosicaoTime extends Model
{
    use HasFactory;

    protected $table = "posicao_time";
    protected $fillable = ['id', 'posicao', 'time_id', 'jogos', 'vitorias', 'empate', 'derrota', 'gols_pro', 'gols_contra', 'status', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public static function list()
    {
        return DB::select( "SELECT
                                posicao AS RANK,
                                SUM(vitorias) * 3 + SUM(empate) AS pontuacao,
                                t.name,
                                t.logo,
                                pt.status,
                                pt.time_id,
                                jogos,
                                vitorias,
                                empate,
                                derrota,
                                gols_pro,
                                gols_contra,
                                gols_pro - gols_contra AS saldo_gols
                            FROM
                                posicao_time pt
                                INNER JOIN times t ON t.id = pt.time_id
                            GROUP BY  posicao,
                                t.name,
                                t.logo,
                                pt.status,
                                jogos,
                                vitorias,
                                empate,
                                derrota,
                                gols_pro,
                                gols_contra,
                                pt.time_id
                            ORDER BY posicao");
    }
    public static function search($time)
    {
        return PosicaoTime::find($time);
    }

    public static function rank()
    {

        $cmd = "SELECT * FROM 
        (
        SELECT
                            @curRank := @curRank + 1 AS RANK,
                            tabela.*
                        FROM
                            (
                                SELECT
                                    TIME AS id,
                                    NAME,
                                    SUM(vitoria)*3 + SUM(empate) AS pontuacao,
                                    SUM(jogos) AS jogos,
                                    SUM(vitoria) AS vitorias,
                                    SUM(empate) AS empate,
                                    (SUM(jogos) - SUM(vitoria)) AS derrota,
                                    SUM(gols_pro) AS gols_pro,
                                    SUM(gols_contra) AS gols_contra,
                                    SUM(gols_pro) - SUM(gols_contra) AS saldo_gols,
                                    confronto_direto
                                FROM
                                    (
                                    
                                        SELECT
                                            t.id AS TIME,
                                            t.name,
                                            r.gols_time_casa,
                                            r.gols_time_fora,
                                            0 AS confronto_direto,
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
                                    TIME
                                            
                            ) AS tabela,
                                            
                            (
                                SELECT
                                    @curRank := 0
                            ) r
                        ORDER BY
                            pontuacao DESC, vitorias DESC, saldo_gols DESC, gols_pro DESC, confronto_direto DESC, NAME ASC 
          ) AS classificacao
           ORDER BY RANK";
        $cmd = DB::select($cmd);
        return $cmd;
    }

    public static function change(PosicaoTime $posicaoTime)
    {
        return $posicaoTime->save();
    }
}

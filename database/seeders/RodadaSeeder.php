<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RodadaSeeder extends Seeder
{
    // Layout - Time Casa, Gols Time Casa, Time Fora, Gols Time Fora
    static $rodadas = array(
        '1|2|3|1',
        '2|3|4|1',
        '3|4|6|3',
        '4|5|9|5',
        '5|3|11|2',
        '6|1|12|0',
        '7|2|14|4',
        '8|0|16|3',
        '9|0|17|0',
        '10|0|15|0',
    );


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$rodadas as $rodada) {
            $rodadaAux = explode("|", $rodada);
            $timeCasa =  $rodadaAux[0];
            $golsTimeCasa = $rodadaAux[1];
            $timeFora = $rodadaAux[2];
            $golsTimeFora = $rodadaAux[3];
            DB::table('rodadas')->insert([
                'time_casa' => $timeCasa,
                'gols_time_casa' => $golsTimeCasa,
                'time_fora' => $timeFora,
                'gols_time_fora' => $golsTimeFora,
                'created_at' => NOW(),
            ]);
        }
    }
}

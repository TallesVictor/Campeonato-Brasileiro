<?php

namespace Database\Seeders;

use App\Http\Controllers\TimesController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosicaoTimeSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = new TimesController();
        $times = $times->show();

        $i = 1;
        foreach ($times as $time) {
            DB::table('posicao_time')->insert([
                'posicao' => $i,
                'time_id' => $time->id,
                'jogos' => 0,
                'vitorias' => 0,
                'empate' => 0,
                'derrota' => 0,
                'gols_pro' => 0,
                'gols_contra' => 0,
            ]);
            $i++;
        }
    }
}

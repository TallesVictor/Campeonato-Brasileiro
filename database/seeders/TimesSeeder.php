<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimesSeeder extends Seeder
{

    static $times = array(
        'América-MG'  => 'img/America-MG.png',
        'Athletico-PR' => 'img/Athletico-PR.png',
        'Atlético-GO' => 'img/atlético-go.png',
        'Atlético-MG' => 'img/atletico-mg.png',
        'Bahia' => 'img/bahia.png',
        'Bragantino' => 'img/rb-bragantino.png',
        'Ceará' => 'img/ceara.png',
        'Chapecoense' => 'img/chapecoense.png',
        'Corinthians' => 'img/Corinthians.png',
        'Cuiabá' => 'img/Cuiaba_EC.png',
        'Flamengo' => 'img/Flamengo.png',
        'Fluminense' => 'img/fluminense.png',
        'Fortaleza' => 'img/fortaleza.png',
        'Grêmio' => 'img/gremio.png',
        'Internacional' => 'img/internacional.png',
        'Juventude' => 'img/juventude.png',
        'Palmeiras' => 'img/Palmeiras.png',
        'Santos' => 'img/santos.png',
        'São Paulo' => 'img/sao-paulo.png',
        'Sport' => 'img/sport.png',
    );


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        new Exception('Teste');
        foreach (self::$times as $chave => $valor) {
            DB::table('times')->insert([
                'name' => $chave,
                'logo' => $valor,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }


    }
}

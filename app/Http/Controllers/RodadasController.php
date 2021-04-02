<?php

namespace App\Http\Controllers;

use App\Models\Rodadas;
use Illuminate\Http\Request;

class RodadasController extends Controller
{
    /** Criar rodadas */
    public function create(Request $request)
    {
        $rodadas = new Rodadas();

        $rodadas = $rodadas->create($request);

        if (isset($rodadas)) {
            return $rodadas;
        } else {
            return response('Nenhuma Rodada encontrado', 500);
        }
    }

    /** Criar rodadas em massa*/
    public function createBulk(Request $request)
    {
        $rodadas = new Rodadas();
        for ($i = 0; $i < 400; $i++) {
            $request->timeCasa = rand(1, 10);
            $request->timeVisitante = rand(11, 20);
            $request->placarCasa = rand(0, 5);
            $request->placarVisitante = rand(0, 5);
            if ($rodadas->create($request) != 'true') {
                return $rodadas->create($request);
            }
        }
        return 'true';
    }
}

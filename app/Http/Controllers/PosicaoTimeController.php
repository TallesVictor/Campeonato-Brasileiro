<?php

namespace App\Http\Controllers;

use App\Models\PosicaoTime;
use Illuminate\Http\Request;

class PosicaoTimeController extends Controller
{
    /** Fazer verificação da classificação */
    public function rank()
    {
        $posicaoTime = new PosicaoTime();
        $posicaoTime = $posicaoTime->rank();

        if (isset($posicaoTime)) {
            return $posicaoTime;
        } else {
            return response('Nenhum Time encontrado', 500);
        }
    }

    /** Listar a tabela do brasileirão serie A */
    public function list()
    {
        $posicaoTime = new PosicaoTime();
        $posicaoTime = $posicaoTime->list();

        if (isset($posicaoTime)) {
            return $posicaoTime;
        } else {
            return response('Nenhum Time encontrado', 500);
        }
    }
    
    /** Alterar um elemento PosicaoTime */
    public function change(PosicaoTime $posicaoTime)
    {
        return $posicaoTime->change($posicaoTime);
    }

    /** Buscar um elemento PosicaoTime */
    public function search($id)
    {
        $posicaoTime = new PosicaoTime();
        $posicaoTime = $posicaoTime->search($id);

        if (isset($posicaoTime)) {
            return $posicaoTime;
        } else {
            return response('Nenhum Time encontrado', 500);
        }
    }
}

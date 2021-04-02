<?php

namespace App\Http\Controllers;

use App\Models\PosicaoTime;
use Illuminate\Http\Request;

class PosicaoTimeController extends Controller
{
    public function rank(){
        $posicaoTime = new PosicaoTime();
        $posicaoTime = $posicaoTime->rank();
        
        if(isset($posicaoTime)){
            return $posicaoTime;
        }else{
            return response('Nenhum Time encontrado', 500);
        }
    }
    
    public function list(){
        $posicaoTime = new PosicaoTime();
        $posicaoTime = $posicaoTime->list();

        if(isset($posicaoTime)){
            return $posicaoTime;
        }else{
            return response('Nenhum Time encontrado', 500);
        }
    }

    public function change(PosicaoTime $posicaoTime){
        return $posicaoTime->change($posicaoTime);
    }

    public function search($id){
        $posicaoTime = new PosicaoTime();
        $posicaoTime = $posicaoTime->search($id);

        if(isset($posicaoTime)){
            return $posicaoTime;
        }else{
            return response('Nenhum Time encontrado', 500);
        }
    }

}

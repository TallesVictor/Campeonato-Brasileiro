<?php

namespace App\Http\Controllers;

use App\Models\PosicaoTime;
use Illuminate\Http\Request;

class PosicaoTimeController extends Controller
{
    public function rank(){
        $posicaoTime = new PosicaoTime();
        return $posicaoTime->rank();
    }
    
    public function list(){
        $posicaoTime = new PosicaoTime();
        return $posicaoTime->list();
    }

    public function change(PosicaoTime $posicaoTime){
        return $posicaoTime->change($posicaoTime);
    }

    public function search($id){
        $posicaoTime = new PosicaoTime();
        return $posicaoTime->search($id);
    }

}

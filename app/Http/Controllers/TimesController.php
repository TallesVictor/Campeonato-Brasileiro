<?php

namespace App\Http\Controllers;

use App\Models\Times;
use Illuminate\Http\Request;

class TimesController extends Controller
{
  

    public function show(){
        $times = new Times();
        $times = $times->show();

        if(isset($times)){
            return $times;
        }else{
            return response('Nenhum Time encontrado', 500);
        }
    }

    public function search($id){
        $times = new Times();
        $times =  $times->search($id);
        if(isset($times)){
            return $times;
        }else{
            return response('Nenhum Time encontrado', 500);
        }
    }

    public function change(Times $times){
        
        return $times->change($times);
    }


}

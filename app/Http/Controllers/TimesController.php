<?php

namespace App\Http\Controllers;

use App\Models\Times;
use Illuminate\Http\Request;

class TimesController extends Controller
{
  

    public function show(){
        $times = new Times();
        return $times->show();
    }

    public function search($id){
        $times = new Times();
        return $times->search($id);
    }

    public function change(Times $times){
        return $times->change($times);
    }


}

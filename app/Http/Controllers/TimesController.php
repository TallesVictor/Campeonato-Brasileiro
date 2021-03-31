<?php

namespace App\Http\Controllers;

use App\Models\Times;
use Illuminate\Http\Request;

class TimesController extends Controller
{
  
    public function index()
    {
        $times = new Times();

        return response()->json($times->index());
    }

    public function show(){
        $times = new Times();
        return $times->show();
    }

    public function create(Request $request){
        $times = new Times();
        return $times->create($request);
    }
}

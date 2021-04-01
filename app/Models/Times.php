<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Times extends Model
{
    use HasFactory;

    protected $table = 'times';
    protected $fillable = ['id', 'name', 'logo', 'created_at', 'update_at'];
    protected $hidden = ['created_at', 'updated_at'];
    

    public function show()
    {
        return Times::all(['id', 'name']);
    }

    public function change(Times $time){
        return $time->save();
    }

    public static function search($id)
    {
        return Times::find($id);
    }


}

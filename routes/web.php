<?php

use App\Http\Controllers\PosicaoTimeController;
use App\Http\Controllers\RodadasController;
use App\Http\Controllers\TimesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#  VIEW
Route::view('/', 'home');

#  TIMES
// Route::get('/index', [TimesController::class, 'index']);
Route::get('/index', [PosicaoTimeController::class, 'list']);
Route::get('/show', [TimesController::class, 'show']);

#  RODADAS
Route::post('/create', [RodadasController::class, 'create']);
Route::post('/createBulk', [RodadasController::class, 'createBulk']);

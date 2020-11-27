<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AppController;
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



Route::get('/', function () {
    return Response('ok', 200);
});
Route::post('/authenticate', [AccountController::class, 'authenticate']);
Route::get('/test', [AccountController::class, 'test']);


Route::prefix('/app')->group( function(){
   Route::get('/', [AppController::class, 'list']);
});

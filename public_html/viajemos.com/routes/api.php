<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LibroController;
use App\Http\Controllers\API\EditorialController;
use App\Http\Controllers\API\AutorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->resource('/libro', LibroController::class);
Route::middleware('api')->resource('/editorial', EditorialController::class);
Route::middleware('api')->resource('/autor', AutorController::class);

Route::get('/', function(){
    echo "Servicio ok";
});


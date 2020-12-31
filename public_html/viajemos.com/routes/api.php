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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/', function(){
    echo "HOLA MUNDO DESDE PHP";
});
Route::resource('libro', LibroController::class);
Route::resource('editorial', EditorialController::class);
Route::resource('autor', AutorController::class);

<?php

use App\Http\Controllers\MascotaController;
use App\Http\Controllers\VeterinarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
    ? Actividad 3. Arquitectura cliente - servidor (primera parte)
    * Saldaña Espinoza Hector
    * 7B
    ! Elaboración: 25 de septiembre del 2021
*/

//// Route::{tipoHTTP}({Nombre_del_path}, {En_que_clase_está}, {cuál_es_el_método})

Route::get(
    '/listarMascotas',
    [MascotaController::class, 'listarMascotas']
);


Route::get(
    '/pruebasConsulta',
    [MascotaController::class, 'pruebasConsulta']
);


// ? Agrupopar las rutas seria -> /mascota/show/{id} o /mascota/destroy/{id}
Route::prefix('mascota')->group(function () {
    Route::post('/store', [MascotaController::class, 'store']);
    Route::get('/showAll',[MascotaController::class, 'showAll']);
    Route::get('/show/{id}',[MascotaController::class, 'show']);
    Route::put('/update', [MascotaController::class, 'update']);
    Route::get('/destroy/{id}', [MascotaController::class, 'destroy']);

    Route::get('/test1',[MascotaController::class,'testCollections']);
});

Route::prefix('veterinario')->group(function () {
    Route::get('/show/{id}', [VeterinarioController::class, 'show']);
    Route::post('/store', [VeterinarioController::class, 'store']);
    Route::get('/consultarVeterinario/{id}', [VeterinarioController::class, 'consultarVeterinario']);

});

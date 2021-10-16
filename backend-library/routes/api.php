<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

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

Route::prefix('category')->group(function(){
    Route::get('/index', [CategoryController::class,'index']);
    Route::post('/store', [CategoryController::class,'store']);
    Route::get('/show/{id}', [CategoryController::class,'show']);
    Route::get('/destroy/{id}', [CategoryController::class,'destroy']);
});

Route::prefix('editorial')->group(function(){
    Route::get('/index', [EditorialController::class,'index']);
    Route::post('/store', [EditorialController::class,'store']);
    Route::get('/show/{id}', [EditorialController::class,'show']);
    Route::get('/destroy/{id}', [EditorialController::class,'destroy']);
});

Route::prefix('author')->group(function (){
    Route::get('/index', [AuthorController::class,'index']);
    Route::post('/store', [AuthorController::class,'store']);
    Route::get('/show/{id}', [AuthorController::class,'show']);
    Route::get('/destroy/{id}', [AuthorController::class,'destroy']);
});

Route::prefix('book')->group(function (){
    Route::get('/show/index/', [BookController::class,'showLikes']);
    Route::get('/index', [BookController::class,'index']);
    Route::post('/store', [BookController::class,'store']);
    Route::get('/show/{id}', [BookController::class,'show']);
    Route::get('/destroy/{id}', [BookController::class,'destroy']);
    Route::get('/show/year/{year}', [BookController::class,'showInYear']);
});

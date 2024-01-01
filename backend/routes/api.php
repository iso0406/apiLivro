<?php

use App\Http\Controllers\ApiLivroController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::fallback(function () {
    return response()->json([
        'status' => 'Error',
        'message' => 'Recurso nao encontrado, favor entrar em contato com o administrador',
        'data' => null,
    ], 404);
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/listAssunto',[AssuntoController::class, 'index']);
    Route::get('/showAssunto/{id}',[AssuntoController::class, 'show']);
    Route::post('/createAssunto',[AssuntoController::class, 'create']);
    Route::put('/editAssunto/{id}',[AssuntoController::class, 'update']);
    Route::put('/destroyAssunto/{id}',[AssuntoController::class, 'destroy']);

    Route::get('/listAutor',[AutorController::class, 'index']);
    Route::get('/showAutor/{id}',[AutorController::class, 'show']);
    Route::post('/createAutor',[AutorController::class, 'create']);
    Route::put('/editAutor/{id}',[AutorController::class, 'update']);
    Route::put('/destroyAutor/{id}',[AutorController::class, 'destroy']);

    Route::get('/list',[ApiLivroController::class, 'index']);
    Route::get('/listBook',[ApiLivroController::class, 'listBook']);
    Route::get('/gerarRelatorio',[ApiLivroController::class, 'gerarRelatorio']);
    Route::get('/show/{id}',[ApiLivroController::class, 'show']);
    Route::post('/create',[ApiLivroController::class, 'create']);
    Route::put('/edit/{id}',[ApiLivroController::class, 'update']);
    Route::put('/destroy/{id}',[ApiLivroController::class, 'destroy']);
});

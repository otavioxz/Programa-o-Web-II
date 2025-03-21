<?php

use App\Http\Controllers\ImcController;
use App\Http\Controllers\SonoController;
use App\Http\Controllers\ViagemController;

Route::get('/', function () {
    return view('index');
});

Route::get('/imc', [ImcController::class, 'index']);
Route::post('/imc/calcular', [ImcController::class, 'calcular']);

Route::get('/sono', [SonoController::class, 'index']);
Route::post('/sono/avaliar', [SonoController::class, 'avaliar']);

Route::get('/viagem', [ViagemController::class, 'index']);
Route::post('/viagem/calcular', [ViagemController::class, 'calcular']);

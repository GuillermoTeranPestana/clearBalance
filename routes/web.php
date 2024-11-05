<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\Grafico1Controller;
use App\Http\Controllers\Grafico2Controller;
use App\Http\Controllers\Grafico3Controller;
use App\Http\Controllers\Grafico4Controller;

//Ruta para mostrar las cuentas 
Route::get('/cuentas/por-usuario', [Grafico2Controller::class, 'cuentasPorUsuario']);
Route::get('/cuentas/{cuenta}/transacciones', [Grafico1Controller::class, 'transacciones']);
Route::get('/cuentas/{cuentaId}', [Grafico1Controller::class, 'showCuenta']);

// Ruta para mostrar la vista de cuentas por usuario
Route::get('/cuentas/graficos/usuarios', [Grafico2Controller::class, 'mostrarGraficoCuentasPorUsuario']);


// Ruta para mostrar la vista de tipo de transacciones por cuenta
Route::get('/cuentas/{CuentaID}/tipo-de-transacciones', [Grafico3Controller::class, 'tipoDeTransacciones']);
Route::get('/cuentas/{cuentaId}/tipo-de-transacciones/graf', [Grafico3Controller::class, 'showtrans']);

// Ruta para mostrar la vista de tipo de descripciones por cuenta
Route::get('/cuentas/{CuentaID}/tipo-de-descripciones', [Grafico4Controller::class, 'tipoDeDescripcion']);
Route::get('/cuentas/{cuentaId}/tipo-de-descripciones/graf', [Grafico4Controller::class, 'showdesc']);



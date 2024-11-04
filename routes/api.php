<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\usuarioController;
use App\Http\Controllers\transaccionController;
use App\Http\Controllers\reporteController;
use App\Http\Controllers\presupuestoController;
use App\Http\Controllers\objetivoFinancieroController;
use App\Http\Controllers\cuentaController;
use App\Http\Controllers\categoriaController;


// Rutas de la API para la entidad de Usuarios
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);



// Rutas de la API para la entidad de Transacciones
Route::get('/transacciones', [TransaccionController::class, 'index']);
Route::get('/transacciones/{id}', [TransaccionController::class, 'show']);
Route::post('/transacciones', [TransaccionController::class, 'store']);
Route::put('/transacciones/{id}', [TransaccionController::class, 'update']);
Route::delete('/transacciones/{id}', [TransaccionController::class, 'destroy']);


// Rutas de la API para la entidad de Reportes
Route::get('/reportes', [ReporteController::class, 'index']);
Route::get('/reportes/{id}', [ReporteController::class, 'show']);
Route::post('/reportes', [ReporteController::class, 'store']);
Route::put('/reportes/{id}', [ReporteController::class, 'update']);
Route::delete('/reportes/{id}', [ReporteController::class, 'destroy']);


// Rutas de la API para la entidad de Presupuestos
Route::get('/presupuestos', [PresupuestoController::class, 'index']);
Route::get('/presupuestos/{id}', [PresupuestoController::class, 'show']);
Route::post('/presupuestos', [PresupuestoController::class, 'store']);
Route::put('/presupuestos/{id}', [PresupuestoController::class, 'update']);
Route::delete('/presupuestos/{id}', [PresupuestoController::class, 'destroy']);


// Rutas de la API para la entidad de Objetivos Financieros
Route::get('/objetivoFinanciero', [ObjetivoFinancieroController::class, 'index']);
Route::get('/objetivoFinanciero/{id}', [ObjetivoFinancieroController::class, 'show']);
Route::post('/objetivoFinanciero', [ObjetivoFinancieroController::class, 'store']);
Route::put('/objetivoFinanciero/{id}', [ObjetivoFinancieroController::class, 'update']);
Route::delete('/objetivoFinanciero/{id}', [ObjetivoFinancieroController::class, 'destroy']);


// Rutas de la API para la entidad de Cuentas
Route::get('/cuentas', [CuentaController::class, 'index']);
Route::get('/cuentas/{id}', [CuentaController::class, 'show']);
Route::post('/cuentas', [CuentaController::class, 'store']);
Route::put('/cuentas/{id}', [CuentaController::class, 'update']);
Route::delete('/cuentas/{id}', [CuentaController::class, 'destroy']);


// Rutas de la API para la entidad de Categorías
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);


<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Grafico1Controller;
use App\Http\Controllers\Grafico2Controller;
use App\Http\Controllers\Grafico3Controller;
use App\Http\Controllers\Grafico4Controller;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\cuentaController;
use App\Http\Controllers\TransaccionController;




//Página principal
Route::get('/', function () {
    return view('inicio'); // 'inicio' corresponde a 'inicio.blade.php'
});

//Registro de usuarios
Route::get('/registro', [RegistroController::class, 'create'])->name('register.create');
Route::post('/registro', [RegistroController::class, 'store'])->name('register.store');


//Página de inicio de sesión
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form'); 
Route::post('/login', [AuthController::class, 'login'])->name('login.submit'); 

// Página principal (home)
Route::get('/home', function () {
    return view('home');  // Vista para la página principal del usuario
})->middleware('auth')->name('home');  // Esto asegura que solo los usuarios autenticados accedan a esta ruta

// Ruta para mostrar el formulario para crear cuenta y transacción
Route::get('/crear', function () {
    return view('create'); // Muestra la vista create.blade.php
})->name('form.create');

// Ruta para almacenar la cuenta
Route::post('/cuentas', [CuentaController::class, 'store'])->name('cuentas.store');

// Ruta para almacenar la transacción
Route::post('/transacciones', [TransaccionController::class, 'store'])->name('transacciones.store');
Route::get('/transacciones/create', [TransaccionController::class, 'create'])
    ->name('transacciones.create')
    ->middleware('auth');

// Ruta para la página de movimientos de cuentas
Route::get('/movimientos', [MovimientosController::class, 'index'])->name('movimientos.index');

//Cierre de sesión
Route::get('/logout', function () {
    Session::forget('user');
    return redirect('/login');
});





//Ruta para mostrar las cuentas 
Route::get('/cuentas/por-usuario', [Grafico2Controller::class, 'cuentasPorUsuario'])->middleware('auth');
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

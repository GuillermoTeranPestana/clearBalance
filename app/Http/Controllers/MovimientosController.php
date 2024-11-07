<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovimientosController extends Controller
{
    public function index()
    {
        return view('movimientos.index'); // Vista para los gráficos de movimientos
    }
}

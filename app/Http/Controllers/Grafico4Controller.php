<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Grafico4Controller extends Controller
{
    public function tipoDeDescripcion($CuentaID)
    {
        try {
            $descripciones = Transaccion::where('CuentaID', $CuentaID)
                ->select('Descripcion', DB::raw('count(*) as total'))
                ->groupBy('Descripcion')
                ->get();
    
            return response()->json($descripciones);
        } catch (\Exception $e) {
            Log::error('Error en tipoDeDescripcion: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener las transacciones por descripcion'], 500);
        }
    }

    public function showdesc($cuentaID)
    {
        return view('tipo_de_descripcion', compact('cuentaID'));
    }
}

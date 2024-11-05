<?php

namespace App\Http\Controllers;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Grafico3Controller extends Controller
{
    public function tipoDeTransacciones($CuentaID)
    {
        try {
            $transacciones = Transaccion::where('CuentaID', $CuentaID)
                ->select('TipoTransaccion', DB::raw('count(*) as total'))
                ->groupBy('TipoTransaccion')
                ->get();
    
            return response()->json($transacciones);
        } catch (\Exception $e) {
            Log::error('Error en tipoDeTransacciones: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener las transacciones por tipo'], 500);
        }
    }

    public function showtrans($cuentaID)
    {
        return view('tipo_de_transacciones', compact('cuentaID'));
    }
}

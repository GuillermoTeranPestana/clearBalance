<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Carbon\Carbon;

class Grafico1Controller extends Controller
{
    public function transacciones($cuentaId)
    {
        // Buscar la cuenta con las transacciones ordenadas por fecha
        $cuenta = Cuenta::with(['transacciones' => function ($query) {
            $query->orderBy('Fecha');
        }])->findOrFail($cuentaId);
    
        // Calcular el saldo acumulativo
        $saldo = 0;
        $data = $cuenta->transacciones->map(function ($transaccion) use (&$saldo) {
            // Formatear la fecha a YYYY-MM-DD
            $fechaFormateada = Carbon::parse($transaccion->Fecha)->format('Y-m-d');
    
            // Actualizar el saldo dependiendo del tipo de transacción
            if ($transaccion->TipoTransaccion === 'ingreso') {
                $saldo += $transaccion->Monto;
            } elseif ($transaccion->TipoTransaccion === 'gasto') {
                $saldo -= $transaccion->Monto;
            }
    
            // Retornar la fecha formateada y el saldo acumulado
            return [
                'fecha' => $fechaFormateada,
                'saldo' => $saldo
            ];
        });
    
        return response()->json([
            'nombreCuenta' => $cuenta->Nombre,
            'data' => $data
        ]);
    }

    public function showCuenta($cuentaId)
    {
        // Obtener la cuenta por ID
        $cuenta = Cuenta::find($cuentaId); 
    
        // Verifica si la cuenta existe
        if (!$cuenta) {
            return redirect()->back()->withErrors('La cuenta no fue encontrada.');
        }
    
        // Pasar la cuentaId a la vista
        return view('cuenta', [
            'cuentaId' => $cuentaId,
            'nombreCuenta' => $cuenta->Nombre, 
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion;
use Carbon\Carbon; 
use App\Models\Cuenta;
use Illuminate\Support\Facades\Auth;

class TransaccionController extends Controller
{

    public function index($cuentaId)
    {
        // Obtener las transacciones de la cuenta
        $transacciones = Transaccion::where('CuentaID', $cuentaId)
            ->orderBy('Fecha')
            ->get();

        // Crear un array para almacenar los datos formateados
        $data = [];

        // Recorrer las transacciones y formatear las fechas
        foreach ($transacciones as $transaccion) {
            $data[] = [
                'fecha' => Carbon::parse($transaccion->Fecha)->format('Y-m-d'), // Formato deseado
                'saldo' => $transaccion->Monto // Suponiendo que Monto es el saldo en ese momento
            ];
        }

        // Obtener el nombre de la cuenta
        $nombreCuenta = $transacciones->first()->Cuenta->Nombre; // Asegúrate de que esto esté bien relacionado

        // Devolver los datos como JSON
        return response()->json(['nombreCuenta' => $nombreCuenta, 'data' => $data]);
    }


    public function show($id)
    {
        $transaccion = Transaccion::find($id);

        if ($transaccion) {
            return response()->json($transaccion);
        } else {
            return response()->json(['message' => 'Transacción no encontrada'], 404);
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'CuentaID' => 'required|exists:cuentas,CuentaID',
            'CategoriaID' => 'required|exists:categorias,CategoriaID',
            'TipoTransaccion' => 'required|in:ingreso,gasto',
            'Monto' => 'required|numeric|min:0',
            'Descripcion' => 'nullable|string',
        ]);

        $transaccion = Transaccion::create($request->all());

        return response()->json($transaccion, 201); 
    }

    public function update(Request $request, $id)
    {
        $transaccion = Transaccion::find($id);

        if ($transaccion) {

            $request->validate([
                'CuentaID' => 'sometimes|required|exists:cuentas,CuentaID',
                'CategoriaID' => 'sometimes|required|exists:categorias,CategoriaID',
                'TipoTransaccion' => 'sometimes|required|in:ingreso,gasto',
                'Monto' => 'sometimes|required|numeric|min:0',
                'Descripcion' => 'nullable|string',
            ]);

            $transaccion->update($request->all());

            return response()->json($transaccion);
        } else {
            return response()->json(['message' => 'Transacción no encontrada'], 404);
        }
    }

    public function destroy($id)
    {
        $transaccion = Transaccion::find($id);

        if ($transaccion) {
            $transaccion->delete();
            return response()->json(['message' => 'Transacción eliminada con éxito']);
        } else {
            return response()->json(['message' => 'Transacción no encontrada'], 404);
        }
    }
}
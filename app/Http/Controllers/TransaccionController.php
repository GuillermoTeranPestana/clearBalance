<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion; 

class TransaccionController extends Controller
{

    public function index()
    {
        $transacciones = Transaccion::all();

        if ($transacciones->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron transacciones'
            ], 404); 
        }

        return response()->json($transacciones);
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;

class CuentaController extends Controller
{

    public function index()
    {
        $cuentas = Cuenta::all();

        if ($cuentas->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron cuentas'
            ], 404); 
        }

        return response()->json($cuentas);
    }

    public function show($id)
    {
        $cuenta = Cuenta::find($id);

        if ($cuenta) {
            return response()->json($cuenta);
        } else {
            return response()->json(['message' => 'Cuenta no encontrada'], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'UsuarioID' => 'required|exists:usuarios,UsuarioID',
                'Nombre' => 'required|string|max:100',
                'TipoCuenta' => 'required|in:ahorros,corriente,tarjeta de crédito,otro',
                'Saldo' => 'required|numeric|min:0',
            ]);
    
            $cuenta = Cuenta::create($request->all());
    
            return response()->json($cuenta, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validación fallida', 'errors' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear cuenta: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $cuenta = Cuenta::find($id);

        if ($cuenta) {
            $request->validate([
                'UsuarioID' => 'sometimes|exists:usuarios,UsuarioID',
                'Nombre' => 'sometimes|string|max:100',
                'TipoCuenta' => 'sometimes|in:ahorros,corriente,tarjeta de crédito,otro',
                'Saldo' => 'sometimes|nullable|numeric|min:0',
            ]);

            $cuenta->update($request->all());
            return response()->json($cuenta);
        } else {
            return response()->json(['message' => 'Cuenta no encontrada'], 404);
        }
    }
    
    public function destroy($id)
    {
        $cuenta = Cuenta::find($id);

        if ($cuenta) {
            $cuenta->delete();
            return response()->json(['message' => 'Cuenta eliminada con éxito']);
        } else {
            return response()->json(['message' => 'Cuenta no encontrada'], 404);
        }
    }
}
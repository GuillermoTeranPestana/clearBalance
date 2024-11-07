<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Auth;

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
            // Validación de los campos del formulario
            $request->validate([
                'Nombre' => 'required|string|max:100',
                'TipoCuenta' => 'required|in:ahorros,corriente,tarjeta de crédito,otro',
                'Saldo' => 'required|numeric|min:0',
            ]);
        
            // Crear la cuenta, asignando el UsuarioID automáticamente con el ID del usuario logueado
            $cuenta = Cuenta::create([
                'Nombre' => $request->Nombre,
                'TipoCuenta' => $request->TipoCuenta,
                'Saldo' => $request->Saldo,
                'UsuarioID' => Auth::id(), // Asignar automáticamente el UsuarioID
            ]);
    
            // Aquí puedes establecer una categoría predeterminada para la transacción inicial
            $categoriaId = 1; // Cambia esto al ID de la categoría que desees usar
        
            // Crear la transacción inicial para la cuenta
            Transaccion::create([
                'CuentaID' => $cuenta->CuentaID,
                'CategoriaID' => $categoriaId, // Usa la categoría predeterminada
                'TipoTransaccion' => 'ingreso',
                'Monto' => $cuenta->Saldo, // Usar el saldo inicial de la cuenta
                'Fecha' => now(), // La fecha actual
                'Descripcion' => 'Creación de cuenta' // Descripción de la transacción
            ]);
        
            // Retornar la cuenta con un código de estado 201
            return back()->with('success', 'Cuenta creada exitosamente.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si hay errores de validación, los enviamos de vuelta con los errores
            return back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            // Si ocurre un error inesperado, capturarlo
            return back()->with('error', 'Error al crear cuenta: ' . $e->getMessage());
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
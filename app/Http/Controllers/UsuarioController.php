<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; 

class UsuarioController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $usuarios = Usuario::all();

        // Comprobar si no hay usuarios
        if ($usuarios->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron usuarios'
            ], 404); // Código 404 para indicar "No encontrado"
        }

        // Devolver la lista de usuarios si existen
        return response()->json($usuarios);
    }

    public function show($Usuarioid)
    {
        $usuario = Usuario::where('Usuarioid', $Usuarioid)->first();

        if ($usuario) {
            return response()->json($usuario);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $usuario = Usuario::create($request->all());
        return response()->json($usuario, 201); // El Código 201 indica que fue creado con éxito
    }

    // Actualizar un usuario existente
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if ($usuario) {
            $usuario->update($request->all());
            return response()->json($usuario);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }

    // Eliminar un usuario
    public function destroy($Usuarioid)
    {
        try {
            $usuario = Usuario::findOrFail($Usuarioid); // Esto lanzará un 404 si no encuentra el usuario.
            $usuario->delete();
            return response()->json(['message' => 'Usuario eliminado con éxito']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (\Exception $e) {
            // Manejo de cualquier otra excepción
            return response()->json(['message' => 'Error al eliminar el usuario: ' . $e->getMessage()], 500);
        }
    }
}

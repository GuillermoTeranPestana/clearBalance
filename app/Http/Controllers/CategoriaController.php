<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        if ($categorias->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron categorías'
            ], 404); 
        }

        return response()->json($categorias);
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            return response()->json($categoria);
        } else {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Tipo' => 'required|in:ingreso,gasto', 
        ]);

        $categoria = Categoria::create($request->all());

        return response()->json($categoria, 201); 
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            $request->validate([
                'Nombre' => 'sometimes|string|max:100',
                'Tipo' => 'sometimes|in:ingreso,gasto',
            ]);

            $categoria->update($request->all());
            return response()->json($categoria);
        } else {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            $categoria->delete();
            return response()->json(['message' => 'Categoría eliminada con éxito']);
        } else {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
    }
}
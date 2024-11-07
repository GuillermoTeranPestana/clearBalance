<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AccesoUsuario;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    // Muestra el formulario de registro
    public function create()
    {
        return view('registro'); // Muestra la vista registro.blade.php
    }

    // Procesa los datos de registro
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'username' => 'required|string|unique:acceso_usuarios,username|max:255',
            'password' => 'required|string|min:8'
        ]);

        // Crea un nuevo usuario en la base de datos
        $usuario = AccesoUsuario::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Encripta la contraseña
        ]);
        if ($usuario) {
            // Iniciar sesión automáticamente con el usuario recién creado
            Auth::login($usuario);
    
            // Redirigir a la página principal del usuario
            return redirect()->route('home')->with('success', 'Usuario registrado y autenticado con éxito');
        }
    
        // Si no se pudo crear el usuario, redirigir con un mensaje de error
        return redirect()->route('register.create')->withErrors(['error' => 'Error al registrar usuario.']);
    }
}
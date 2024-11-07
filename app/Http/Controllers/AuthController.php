<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccesoUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;  // Importar la fachada Auth

class AuthController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        // Validación de las credenciales
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Obtener el usuario basado en el nombre de usuario
        $user = AccesoUsuario::where('username', $request->username)->first();

        // Verificar si el usuario existe y si la contraseña es correcta
        if ($user && Hash::check($request->password, $user->password)) {
            // Iniciar sesión utilizando Auth::login()
            Auth::login($user); 

            // Redirigir a la página principal o a la página de inicio
            return redirect()->route('home');
        }

        // Si las credenciales no coinciden, mostrar error
        return back()->withErrors([
            'username' => 'Las credenciales no coinciden con nuestros registros.'
        ]);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();  // Esto cierra la sesión del usuario
        return redirect()->route('login');  // Redirigir a la página de login
    }
}
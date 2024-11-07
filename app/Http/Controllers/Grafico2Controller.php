<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Grafico2Controller extends Controller
{
    public function cuentasPorUsuario()
    {
        // Obtener el usuario logueado
        $usuarioId = Auth::id();

        // Obtener el número de cuentas del usuario logueado
        $cuentas = Cuenta::where('UsuarioID', $usuarioId)
            ->select('UsuarioID', DB::raw('count(*) as total_cuentas'))
            ->groupBy('UsuarioID')
            ->get();

        // Preparar la respuesta con el nombre del usuario y el total de cuentas
        $usuario = Usuario::find($usuarioId);

        $resultado = $cuentas->map(function ($cuenta) use ($usuario) {
            return [
                'nombreUsuario' => $usuario ? $usuario->Nombre : 'Desconocido',
                'totalCuentas' => $cuenta->total_cuentas
            ];
        });

        return response()->json($resultado);
    }

    public function mostrarGraficoCuentasPorUsuario()
    {
        // Solo necesitamos devolver la vista sin pasar datos de una cuenta específica
        return view('cuentas_por_usuario');
    }
}

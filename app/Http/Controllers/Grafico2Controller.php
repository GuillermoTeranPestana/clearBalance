<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class Grafico2Controller extends Controller
{
    public function cuentasPorUsuario()
    {
        // Obtener el número de cuentas agrupadas por UsuarioID
        $cuentas = Cuenta::select('UsuarioID', DB::raw('count(*) as total_cuentas'))
            ->groupBy('UsuarioID')
            ->get();

        $resultado = $cuentas->map(function ($cuenta) {
            $usuario = Usuario::find($cuenta->UsuarioID); 
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

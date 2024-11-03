<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuenta extends Model
{
    use HasFactory;

    // Tabla en la base de datos
    protected $table = 'cuentas';

    // Clave primaria
    protected $primaryKey = 'CuentaID';
    
    // Campos permitidos para inserciones masivas
    protected $fillable = ['UsuarioID', 'Nombre', 'TipoCuenta', 'Saldo'];

    // Relación N:1 con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UsuarioID', 'UsuarioID');
    }

    // Relación 1:N con Transacciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'CuentaID', 'CuentaID');
    }
}


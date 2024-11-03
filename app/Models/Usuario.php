<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    // Tabla en la base de datos
    protected $table = 'usuarios'; 

    // Clave primaria en la base de datos
    protected $primaryKey = 'UsuarioID';

    // Campos permitidos para inserciones masivas
    protected $fillable = ['Nombre', 'Email', 'Contraseña', 'FechaRegistro'];

    // Deshabilitar el manejo de timestamps
    public $timestamps = false;
    
    // Relación 1:N con Cuentas
    public function cuentas()
    {
        return $this->hasMany(Cuenta::class, 'UsuarioID', 'UsuarioID');
    }

    // Relación 1:N con Presupuestos
    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'UsuarioID', 'UsuarioID');
    }

    // Relación 1:N con Objetivos Financieros
    public function objetivosFinancieros()
    {
        return $this->hasMany(ObjetivoFinanciero::class, 'UsuarioID', 'UsuarioID');
    }

    // Relación 1:N con Reportes
    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'UsuarioID', 'UsuarioID');
    }
}

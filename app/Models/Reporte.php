<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';

    protected $primaryKey = 'ReporteID';

    protected $fillable = ['UsuarioID', 'FechaInicio', 'FechaFin', 'TotalIngresos', 'TotalGastos'];

    // Relación N:1 con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UsuarioID', 'UsuarioID');
    }
}

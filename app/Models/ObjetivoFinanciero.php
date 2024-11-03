<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjetivoFinanciero extends Model
{
    use HasFactory;

    protected $table = 'objetivosfinancieros';

    protected $primaryKey = 'ObjetivoID';

    protected $fillable = ['UsuarioID', 'Nombre', 'MontoObjetivo', 'MontoAcumulado', 'FechaObjetivo'];

    // Relación N:1 con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UsuarioID', 'UsuarioID');
    }
}

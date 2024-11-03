<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presupuesto extends Model
{
    use HasFactory;

    protected $table = 'presupuestos';

    protected $primaryKey = 'PresupuestoID';

    protected $fillable = ['UsuarioID', 'CategoriaID', 'CantidadMaxima', 'Periodo'];

    // Relación N:1 con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'UsuarioID', 'UsuarioID');
    }

    // Relación N:1 con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'CategoriaID', 'CategoriaID');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $primaryKey = 'CategoriaID';

    protected $fillable = ['Nombre', 'Tipo'];

    // Relación 1:N con Transacciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'CategoriaID', 'CategoriaID');
    }

    // Relación 1:N con Presupuestos
    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'CategoriaID', 'CategoriaID');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';

    protected $primaryKey = 'TransaccionID';

    protected $fillable = ['CuentaID', 'CategoriaID', 'TipoTransaccion', 'Cantidad', 'Fecha', 'Descripcion'];

    // Relación N:1 con Cuenta
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'CuentaID', 'CuentaID');
    }

    // Relación N:1 con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'CategoriaID', 'CategoriaID');
    }
}

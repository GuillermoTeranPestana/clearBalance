<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de Authenticatable en lugar de Model
use Illuminate\Notifications\Notifiable;

class AccesoUsuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'acceso_usuarios'; // Nombre correcto de la tabla

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
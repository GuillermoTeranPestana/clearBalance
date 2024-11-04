<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition()
    {
        return [
            'Nombre' => $this->faker->name,
            'Email' => $this->faker->unique()->safeEmail,
            'Contraseña' => bcrypt('password'),
            'FechaRegistro' => now(),
        ];
    }
}


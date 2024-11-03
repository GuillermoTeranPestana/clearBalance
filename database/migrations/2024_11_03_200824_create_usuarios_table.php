<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('UsuarioID');              // UsuarioID. Clave primaria auto-incremental
            $table->string('Nombre', 100);        // Nombre. Máximo de 100 caracteres, NOT NULL
            $table->string('Email', 100)->unique(); // Email. Máximo de 100 caracteres, único y NOT NULL
            $table->string('Contraseña');         // Contraseña
            $table->timestamp('FechaRegistro')->useCurrent(); // Fecha de registro
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

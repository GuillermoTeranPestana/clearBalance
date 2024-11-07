<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('acceso_usuarios', function (Blueprint $table) { 
            $table->id();
            $table->string('username')->unique();  // Campo de nombre de usuario
            $table->string('password');  // Campo de la contraseña
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acceso_usuarios'); // Solo elimina la tabla creada en esta migración
    }
};

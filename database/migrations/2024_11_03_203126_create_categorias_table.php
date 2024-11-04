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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('CategoriaID');                 // Clave primaria auto-incremental
            $table->string('Nombre', 100);             // Nombre de la categoría, VARCHAR(100) y NOT NULL
            
            // Tipo de categoría como ENUM con valores 'ingreso' o 'gasto'
            $table->enum('Tipo', ['ingreso', 'gasto'])->default('gasto'); // Obligatorio, sin valor por defecto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};


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
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id('PresupuestoID');                // Clave primaria auto-incremental
            $table->unsignedBigInteger('UsuarioID');     // Clave foránea a la tabla Usuarios
            $table->unsignedBigInteger('CategoriaID');   // Clave foránea a la tabla Categorías
            $table->decimal('MontoMaximo', 15, 2);       // Monto máximo, DECIMAL(15,2) y NOT NULL
            $table->enum('Periodo', ['mensual', 'anual']); // Periodo de presupuesto como ENUM

            // Definir las claves foráneas
            $table->foreign('UsuarioID')->references('UsuarioID')->on('usuarios')->onDelete('cascade');
            $table->foreign('CategoriaID')->references('CategoriaID')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuestos');
    }
};

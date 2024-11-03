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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id('ReporteID');                     // Clave primaria auto-incremental
            $table->unsignedBigInteger('UsuarioID');      // Clave foránea a la tabla Usuarios
            $table->date('FechaInicio');                   // Fecha de inicio, tipo DATE y NOT NULL
            $table->date('FechaFin');                      // Fecha de fin, tipo DATE y NOT NULL
            $table->decimal('TotalIngresos', 15, 2)->default(0.00); // Total de ingresos, con valor predeterminado de 0.00
            $table->decimal('TotalGastos', 15, 2)->default(0.00);   // Total de gastos, con valor predeterminado de 0.00

            // Definir la clave foránea hacia la tabla usuarios
            $table->foreign('UsuarioID')->references('UsuarioID')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};

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
        Schema::create('objetivosfinancieros', function (Blueprint $table) {
            $table->id('ObjetivoID');                     // Clave primaria auto-incremental
            $table->unsignedBigInteger('UsuarioID');      // Clave foránea a la tabla Usuarios
            $table->string('Nombre', 100);                // Nombre del objetivo, VARCHAR(100) y NOT NULL
            $table->decimal('MontoObjetivo', 15, 2);      // Monto objetivo, DECIMAL(15,2) y NOT NULL
            $table->decimal('MontoAcumulado', 15, 2)->default(0.00); // Monto acumulado, con valor predeterminado de 0.00
            $table->date('FechaObjetivo')->nullable();    // Fecha objetivo, de tipo DATE y opcional

            // Definir la clave foránea hacia la tabla usuarios
            $table->foreign('UsuarioID')->references('UsuarioID')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetivosfinancieros');
    }
};

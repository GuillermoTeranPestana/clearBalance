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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id('TransaccionID');                // Clave primaria auto-incremental
            $table->unsignedBigInteger('CuentaID');     // Clave foránea a la tabla Cuentas
            $table->unsignedBigInteger('CategoriaID');  // Clave foránea a la tabla Categorias

            // Tipo de transacción como ENUM
            $table->enum('TipoTransaccion', ['ingreso', 'gasto'])->default('gasto'); // Valor por defecto en 'gasto'

            $table->decimal('Monto', 15, 2);            // Monto de la transacción, DECIMAL(15,2)
            $table->timestamp('Fecha')->useCurrent();   // Fecha con valor predeterminado actual
            $table->text('Descripcion')->nullable();    // Descripción opcional de la transacción
            
            // Definir las claves foráneas
            $table->foreign('CuentaID')->references('CuentaID')->on('cuentas')->onDelete('cascade');
            $table->foreign('CategoriaID')->references('CategoriaID')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};

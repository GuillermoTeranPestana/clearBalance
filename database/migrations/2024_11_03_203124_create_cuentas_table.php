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
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id('CuentaID');                       // Clave primaria auto-incremental
            $table->unsignedBigInteger('UsuarioID');      // Clave foránea hacia la tabla Usuarios
            $table->string('Nombre', 100);                // Nombre de la cuenta (VARCHAR 100)
            
            // Tipo de cuenta como ENUM usando 'set'
            $table->enum('TipoCuenta', ['ahorros', 'corriente', 'tarjeta de crédito', 'otro'])->default('otro'); 
            
            $table->decimal('Saldo', 15, 2)->default(0.00); // Saldo en la cuenta (DECIMAL)
            
            // Definir la clave foránea con referencia a 'UsuarioID' en 'usuarios'
            $table->foreign('UsuarioID')->references('UsuarioID')->on('usuarios')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas');
    }
};

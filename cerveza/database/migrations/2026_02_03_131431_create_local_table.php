<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración: crear la tabla "local"
     */
    public function up(): void
    {
        Schema::create('local', function (Blueprint $table) {
            // ID autoincremental del local
            $table->id();

            // Nombre del local
            $table->string('nombre');

            // Relación con el usuario propietario
            // Si se elimina el usuario, el local también se elimina
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Correo electrónico único del local
            $table->string('email')->unique();

            // Número de teléfono del local
            $table->string('telefono');

            // Fechas de creación y actualización del registro
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración: eliminar la tabla "local"
     */
    public function down(): void
    {
        Schema::dropIfExists('local');
    }
};

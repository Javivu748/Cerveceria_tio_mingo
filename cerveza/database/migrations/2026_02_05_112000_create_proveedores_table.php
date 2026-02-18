<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración: crear la tabla "proveedores"
     */
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            // ID autoincremental del proveedor
            $table->id();

            // Nombre de la distribuidora
            $table->string('nombre_distribuidora');

            // Contacto de la distribuidora
            // Nota: hay un typo en "contaco", debería ser "contacto"
            $table->string('contaco');

            // Teléfono de contacto
            $table->string('telefono');

            // Plazo de entrega estimado en días (valor positivo)
            $table->integer('plazo_entrega_estimado')->unsigned();

            // Timestamps: created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración: eliminar la tabla "proveedores"
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};

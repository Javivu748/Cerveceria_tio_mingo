<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración: crear la tabla intermedia "cerveza_proveedor"
     */
    public function up()
    {
        Schema::create('cerveza_proveedor', function (Blueprint $table) {
            // ID autoincremental de la relación
            $table->id(); 
            
            // Clave foránea a la tabla de cervezas
            // Si se elimina una cerveza, también se eliminan sus relaciones
            $table->foreignId('cerveza_id')
                  ->constrained('cervezas')
                  ->onDelete('cascade');
                  
            // Clave foránea a la tabla de proveedores
            // Si se elimina un proveedor, también se eliminan sus relaciones
            $table->foreignId('proveedor_id')
                  ->constrained('proveedores')
                  ->onDelete('cascade');
            
            // Timestamps: created_at y updated_at
            $table->timestamps();
            
            // Evita duplicados: la misma cerveza no puede repetirse con el mismo proveedor
            $table->unique(['cerveza_id', 'proveedor_id']);
        });
    }

    /**
     * Revertir la migración: eliminar la tabla "cerveza_proveedor"
     */
    public function down()
    {
        Schema::dropIfExists('cerveza_proveedor');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración: crear la tabla "detalle_pedidos"
     */
    public function up(): void
    {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            // Clave primaria
            $table->id();
            
            // Relación con la tabla "pedidos"
            // Si se elimina un pedido, sus detalles también se eliminan automáticamente
            $table->foreignId('pedido_id')
                  ->constrained('pedidos')
                  ->onDelete('cascade');
            
            // Relación con la tabla "cervezas"
            // Si se elimina una cerveza, los detalles relacionados se eliminan
            $table->foreignId('cerveza_id')
                  ->constrained('cervezas')
                  ->onDelete('cascade');
            
            // Cantidad de unidades pedidas
            $table->integer('cantidad');

            // Precio por unidad
            $table->decimal('precio_unitario', 10, 2);

            // Subtotal = cantidad * precio_unitario
            $table->decimal('subtotal', 10, 2);
            
            // Timestamps de creación y actualización
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración: eliminar la tabla "detalle_pedidos"
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};

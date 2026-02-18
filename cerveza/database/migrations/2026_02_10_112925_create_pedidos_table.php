<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración: crear la tabla "pedidos"
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            // ID autoincremental del pedido
            $table->id();

            // Relación con el usuario que realiza el pedido
            // Si el usuario se elimina, también se eliminan sus pedidos
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Estado del pedido (pendiente, completado, etc.)
            $table->string('estado');

            // Total del pedido
            $table->decimal('total', 10, 2);

            // Método de pago usado (paypal, tarjeta, etc.)
            $table->string('metodoPago');

            // Timestamps: created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración: eliminar la tabla "pedidos"
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

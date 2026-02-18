<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Modificar la columna "metodoPago" de la tabla "pedidos"
     */
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Permitimos que pueda ser nulo y establecemos "paypal" como valor por defecto
            $table->string('metodoPago')->nullable()->default('paypal')->change();
        });
    }

    /**
     * Revertir los cambios realizados en "metodoPago"
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Volvemos a hacer que no pueda ser nulo
            $table->string('metodoPago')->nullable(false)->change();
        });
    }
};

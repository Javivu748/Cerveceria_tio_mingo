<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración: agregar columnas de PayPal a la tabla "pedidos"
     */
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // ID de la orden en PayPal, único y opcional
            $table->string('paypal_order_id')->nullable()->unique()->after('estado');

            // ID del pagador en PayPal
            $table->string('paypal_payer_id')->nullable()->after('paypal_order_id');

            // Email del pagador en PayPal
            $table->string('paypal_payer_email')->nullable()->after('paypal_payer_id');
        });
    }

    /**
     * Revertir la migración: eliminar las columnas de PayPal
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['paypal_order_id', 'paypal_payer_id', 'paypal_payer_email']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agregar la columna "fecha" a la tabla "pedidos"
     */
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Creamos un campo timestamp llamado "fecha" justo después de "user_id"
            // Se inicializa con la fecha y hora actual por defecto
            $table->timestamp('fecha')->after('user_id')->default(now());
        });
    }

    /**
     * Revertir los cambios realizados en la tabla "pedidos"
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Eliminamos la columna "fecha" si hacemos rollback
            $table->dropColumn('fecha');
        });
    }
};

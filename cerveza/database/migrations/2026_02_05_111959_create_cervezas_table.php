<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración: crear la tabla "cervezas"
     */
    public function up(): void
    {
        Schema::create('cervezas', function (Blueprint $table) {
            // ID autoincremental de la cerveza
            $table->id();

            // Fechas de creación y actualización
            $table->timestamps();

            // Nombre de la cerveza
            $table->string('name');

            // Formato de la cerveza (botella, lata, etc.)
            $table->string('formato');

            // Capacidad en ml o litros (decimal con 2 decimales)
            $table->decimal('capacidad', 5, 2);

            // URL de la imagen, puede estar vacía
            $table->string('imagen_url', 500)->nullable();

            // Precio en euros, puede estar vacío
            $table->decimal('precio_eur', 8, 2)->nullable();

            // Relación con estilos: cada cerveza tiene un estilo
            $table->foreignId('estilo_id')
                  ->constrained('estilos')
                  ->onDelete('cascade');

            // Relación con cervecerías: cada cerveza pertenece a una cervecería
            $table->foreignId('cerveceria_id')
                  ->constrained('cervecerias')
                  ->onDelete('cascade');
        });
    }

    /**
     * Revertir la migración: eliminar la tabla "cervezas"
     */
    public function down(): void
    {
        Schema::dropIfExists('cervezas');
    }
};

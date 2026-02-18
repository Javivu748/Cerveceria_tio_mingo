<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crear la tabla "comentarios"
     */
    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            // ID autoincremental
            $table->id();

            // Nombre de la persona que hace el comentario
            $table->string('nombre', 100);

            // Puntuación (valor del 1 al 5, por ejemplo)
            $table->unsignedTinyInteger('puntuacion');

            // Texto del comentario
            $table->text('texto');

            // Fechas de creación y actualización
            $table->timestamps();
        });
    }

    /**
     * Eliminar la tabla "comentarios"
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};

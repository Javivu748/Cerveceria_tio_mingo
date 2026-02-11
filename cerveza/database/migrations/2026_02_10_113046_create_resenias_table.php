<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Se ejecuta al correr php artisan migrate
    public function up(): void
    {
        Schema::create('resenias', function (Blueprint $table) {
            $table->id(); // Clave primaria

            // Clave foránea hacia cervezas
            $table->foreignId('cerveza_id')
                  ->constrained('cervezas')
                  ->onDelete('cascade'); // Si se elimina la cerveza, se eliminan sus reseñas

            // Clave foránea hacia users
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade'); // Si se elimina el usuario, se eliminan sus reseñas

            $table->integer('puntuacion'); // Valoración numérica (ej: 1 a 5)
            $table->text('comentario')->nullable(); // Comentario opcional
            $table->date('fecha'); // Fecha de la reseña

            $table->timestamps(); // created_at y updated_at
        });
    }

    // Se ejecuta al hacer rollback
    public function down(): void
    {
        Schema::dropIfExists('resenias');
    }
};

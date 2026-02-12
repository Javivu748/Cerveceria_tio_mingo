<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cervezas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('formato');
            $table->decimal('capacidad', 5, 2);
            $table->string('imagen_url',500)->nullable();
            $table->decimal('precio_eur', 8, 2)->nullable();
            
            // Claves foráneas
            $table->foreignId('estilo_id')
                  ->constrained('estilos')
                  ->onDelete('cascade');
                  
            $table->foreignId('cerveceria_id')
                  ->constrained('cervecerias')
                  ->onDelete('cascade');
            
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cervezas');
    }
};

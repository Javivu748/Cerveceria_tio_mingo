<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración: crear la tabla "cervecerias"
     */
    public function up(): void
    {
        Schema::create('cervecerias', function (Blueprint $table) {
            // ID autoincremental de la cervecería
            $table->id();

            // Nombre de la cervecería
            $table->string('nombre');

            // Ciudad y país donde se encuentra la cervecería
            $table->string('pais_ciudad');

            // Latitud geográfica (opcional)
            $table->decimal('latitud', 10, 7)->nullable();

            // Longitud geográfica (opcional)
            $table->decimal('longitud', 10, 7)->nullable();

            // Año de fundación de la cervecería
            $table->integer('anio_fundacion');

            // Descripción de la cervecería
            $table->text('descripcion');

            // URL del sitio web (opcional)
            $table->string('sitio_web')->nullable();

            // Fechas de creación y actualización de registro
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración: eliminar la tabla "cervecerias"
     */
    public function down(): void
    {
        Schema::dropIfExists('cervecerias');
    }
};

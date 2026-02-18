<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory para crear cervecerías de prueba
 */
class CerveceriaFactory extends Factory
{
    /**
     * Define los valores por defecto para el modelo
     */
    public function definition(): array
    {
        return [
            // Nombre de la cervecería
            'nombre' => $this->faker->company(),

            // País y ciudad separados por guion
            'pais_ciudad' => $this->faker->country() . ' - ' . $this->faker->city(),

            // Año de fundación entre 1800 y 2024
            'anio_fundacion' => $this->faker->numberBetween(1800, 2024),

            // Descripción con varios párrafos
            'descripcion' => $this->faker->paragraphs(3, true),

            // Sitio web de la cervecería
            'sitio_web' => $this->faker->url(),
        ];
    }
}

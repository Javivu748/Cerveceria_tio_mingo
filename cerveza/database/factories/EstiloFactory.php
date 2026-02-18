<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory para crear estilos de cerveza de prueba
 */
class EstiloFactory extends Factory
{
    /**
     * Define los valores por defecto para el modelo
     */
    public function definition(): array
    {
        return [
            // Aquí puedes poner los valores falsos para un estilo de cerveza
            // Por ejemplo:
            // 'nombre' => $this->faker->word(),
            // 'tipo_fermentacion' => $this->faker->randomElement(['Alta', 'Baja']),
            // 'descripcion' => $this->faker->sentence(),
        ];
    }
}

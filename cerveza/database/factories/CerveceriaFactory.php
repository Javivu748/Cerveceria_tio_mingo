<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cerveceria>
 */
class CerveceriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company(),
            'pais_ciudad' => $this->faker->country() . ' - ' . $this->faker->city(),
            'anio_fundacion' => $this->faker->numberBetween(1800, 2024),
            'descripcion' => $this->faker->paragraphs(3, true),
            'sitio_web' => $this->faker->url(),
        ];
    }
}

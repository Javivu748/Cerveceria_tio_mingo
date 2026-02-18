<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * Factory para crear locales de prueba
 */
class LocalFactory extends Factory
{
    /**
     * Define los valores por defecto para el modelo
     */
    public function definition(): array
    {
        return [
            // Nombre del local
            'nombre' => fake()->firstName(),

            // Asociamos el local a un usuario creado con su factory
            'user_id' => User::factory()->create()->id,

            // Teléfono de contacto del local
            'telefono' => fake()->phoneNumber(),

            // Email del local
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}

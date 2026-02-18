<?php

namespace Database\Factories;

use App\Models\Resenia;
use App\Models\User;
use App\Models\Cerveza;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory para crear reseñas de cervezas
 */
class ReseniaFactory extends Factory
{
    // Modelo al que pertenece esta factory
    protected $model = Resenia::class;

    /**
     * Define los valores por defecto de una reseña
     */
    public function definition(): array
    {
        return [
            // Asignar una cerveza aleatoria o crear una nueva si no hay
            'cerveza_id' => Cerveza::inRandomOrder()->first()?->id ?? Cerveza::factory(),

            // Asignar un usuario aleatorio o crear uno nuevo si no hay
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),

            // Puntuación de 1 a 5
            'puntuacion' => $this->faker->numberBetween(1, 5),

            // Comentario de ejemplo
            'comentario' => $this->faker->sentence(),

            // Fecha de la reseña
            'fecha' => $this->faker->date(),
        ];
    }
}

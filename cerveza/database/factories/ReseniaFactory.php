<?php

namespace Database\Factories;

use App\Models\Resenia;
use App\Models\User;
use App\Models\Cerveza;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReseniaFactory extends Factory
{
    protected $model = Resenia::class; // Modelo al que pertenece el factory

    public function definition(): array
    {
        return [
            // Asigna una cerveza existente o crea una nueva
            'cerveza_id' => Cerveza::inRandomOrder()->first()?->id ?? Cerveza::factory(),

            // Asigna un usuario existente o crea uno nuevo
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),

            'puntuacion' => $this->faker->numberBetween(1, 5), // Número entre 1 y 5
            'comentario' => $this->faker->sentence(), // Comentario aleatorio
            'fecha' => $this->faker->date(), // Fecha aleatoria
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition(): array
    {
        return [
            'fecha' => $this->faker->date(),
            'user_id' => User::factory(), // crea un usuario automáticamente
            'estado' => $this->faker->randomElement(['pendiente', 'procesando', 'entregado']),
            'total' => $this->faker->randomFloat(2, 100, 1000),
            'metodoPago' => $this->faker->randomElement(['efectivo', 'tarjeta', 'transferencia']),
        ];
    }
}

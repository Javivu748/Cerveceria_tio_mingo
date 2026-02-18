<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory para crear pedidos de prueba
 */
class PedidoFactory extends Factory
{
    // Especificamos el modelo que esta factory genera
    protected $model = Pedido::class;

    /**
     * Define los valores por defecto del pedido
     */
    public function definition(): array
    {
        return [
            // Fecha del pedido
            'fecha' => $this->faker->date(),

            // Asociamos el pedido a un usuario creado automáticamente
            'user_id' => User::factory(),

            // Estado del pedido
            'estado' => $this->faker->randomElement(['pendiente', 'procesando', 'entregado']),

            // Total del pedido
            'total' => $this->faker->randomFloat(2, 100, 1000),

            // Método de pago
            'metodoPago' => $this->faker->randomElement(['efectivo', 'tarjeta', 'transferencia']),
        ];
    }
}

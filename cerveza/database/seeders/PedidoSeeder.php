<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Cerveza;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos 10 pedidos
        Pedido::factory(10)->create()->each(function ($pedido) {
            // Asociamos entre 1 y 5 cervezas a cada pedido
            $cervezas = Cerveza::inRandomOrder()->take(rand(1, 5))->pluck('id');
            foreach ($cervezas as $cerveza_id) {
                $pedido->cervezas()->attach($cerveza_id, ['cantidad' => rand(1, 3)]);
            }
        });
    }
}

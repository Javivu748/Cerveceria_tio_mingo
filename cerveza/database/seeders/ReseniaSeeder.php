<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resenia;

class ReseniaSeeder extends Seeder
{
    // Se ejecuta al correr php artisan db:seed
    public function run(): void
    {
        // Crea 20 reseñas usando el factory
        Resenia::factory(20)->create();
    }
}

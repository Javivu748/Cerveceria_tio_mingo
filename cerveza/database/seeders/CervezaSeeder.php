<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CervezaSeeder extends Seeder
{
    public function run()
    {
        $csvFile = database_path('data/cervezas.csv');
        
        if (!File::exists($csvFile)) {
            $this->command->error('El archivo cervezas.csv no existe!');
            return;
        }

        $file = fopen($csvFile, 'r');
        
        // Saltar encabezados
        $header = fgetcsv($file);
        
        // Deshabilitar restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Limpiar tabla (opcional)
        DB::table('cervezas')->truncate();
        
        // Habilitar restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Importar datos
        while (($row = fgetcsv($file)) !== false) {
            DB::table('cervezas')->insert([
                'id' => $row[0],
                'name' => $row[1],
                'estilo_id' => $row[2],
                'cerveceria_id' => $row[3],
                'formato' => $row[5],
                'capacidad' => $row[6],
                'imagen_url' => $row[7] ?? null,
                'precio_eur' => isset($row[8]) ? (float)str_replace(',', '.', $row[8]) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        fclose($file);
        
        $this->command->info('Cervezas importadas correctamente!');
    }
}
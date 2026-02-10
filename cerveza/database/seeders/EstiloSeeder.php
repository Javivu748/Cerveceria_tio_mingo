<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EstiloSeeder extends Seeder
{
    public function run()
    {
        // Leer el archivo CSV
        $csvFile = database_path('data/estilos.csv');
        
        if (!File::exists($csvFile)) {
            $this->command->error('El archivo estilos.csv no existe!');
            return;
        }

        $file = fopen($csvFile, 'r');
        
        // Saltar la primera línea (encabezados)
        $header = fgetcsv($file);
        
        // Limpiar tabla antes de insertar (opcional)
        DB::table('estilos')->truncate();
        
        // Leer cada línea del CSV
        while (($row = fgetcsv($file)) !== false) {
            DB::table('estilos')->insert([
                'id' => $row[0],
                'nombre' => $row[1],
                'tipo_fermentacion' => $row[2],
                'descripcion' => $row[3],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        fclose($file);
        
        $this->command->info('Estilos importados correctamente!');
    }
}
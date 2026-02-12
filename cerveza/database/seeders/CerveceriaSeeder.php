<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CerveceriaSeeder extends Seeder
{
    public function run()
    {
        // Leer el archivo CSV
        $csvFile = database_path('data/cervecerias.csv');
        
        if (!File::exists($csvFile)) {
            $this->command->error('El archivo cervecerias.csv no existe!');
            return;
        }

        $file = fopen($csvFile, 'r');
        
        // Saltar la primera línea (encabezados)
        $header = fgetcsv($file);
        
        // Deshabilitar restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Limpiar tabla antes de insertar (opcional)
        DB::table('cervecerias')->truncate();
        
        // Habilitar restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Leer cada línea del CSV
        while (($row = fgetcsv($file)) !== false) {
            DB::table('cervecerias')->insert([
                'id' => $row[0],
                'nombre' => $row[1],
                'pais_ciudad' => $row[2],
                'latitud' => $row[3],
                'longitud' => $row[4],
                'anio_fundacion' => $row[5],
                'descripcion' => $row[6],
                'sitio_web' => $row[7],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        fclose($file);
        
        $this->command->info('Cervecerías importadas correctamente!');
    }
}
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
        
        // Limpiar tabla (opcional)
        DB::table('cervezas')->truncate();
        
        // Importar datos
        while (($row = fgetcsv($file)) !== false) {
            DB::table('cervezas')->insert([
                'id' => $row[0],
                'nombre' => $row[1],
                'estilo_id' => $row[2],
                'cerveceria_id' => $row[3],
                // Si tienes una tabla separada de cervecerias, solo necesitas cerveceria_id
                // Si no, puedes agregar el campo cerveceria_nombre
                'formato' => $row[5],
                'capacidad_cl' => $row[6],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        fclose($file);
        
        $this->command->info('Cervezas importadas correctamente!');
    }
}
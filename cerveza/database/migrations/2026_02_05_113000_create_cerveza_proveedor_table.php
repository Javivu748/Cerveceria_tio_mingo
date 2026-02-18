<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cerveza_proveedor', function (Blueprint $table) {
            $table->id(); 
            
            // Claves foráneas
            $table->foreignId('cerveza_id')
                  ->constrained('cervezas')
                  ->onDelete('cascade');
                  
            $table->foreignId('proveedor_id')
                  ->constrained('proveedores')
                  ->onDelete('cascade');
            
            $table->timestamps();
            
            // Evita duplicados para la misma cerveza y proveedor
            $table->unique(['cerveza_id', 'proveedor_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cerveza_proveedor');
    }
};
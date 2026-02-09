<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cervecería extends Model
{
    /** @use HasFactory<\Database\Factories\CerveceríaFactory> */
    use HasFactory;

    protected $table = 'cervecerías';

    protected $fillable = [
        'nombre',
        'pais_ciudad',
        'anio_fundacion',
        'descripcion',
        'sitio_web',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estilo extends Model
{
    /** @use HasFactory<\Database\Factories\EstiloFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo_fermentacion',
        'descripcion_breve',
    ];
}

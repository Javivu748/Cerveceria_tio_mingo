<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    // Campos que se pueden llenar de forma masiva
    protected $fillable = ['nombre', 'puntuacion', 'texto'];

    // Esto representa un comentario que los usuarios pueden dejar
}

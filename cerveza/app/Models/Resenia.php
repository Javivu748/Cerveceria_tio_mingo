<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resenia extends Model
{
   protected $table = "Resenia";
    protected $fillable = [
        'cerveza_id',
        'user_id',
        'puntuacion',
        'comentario',
        'fecha',
    ];
}

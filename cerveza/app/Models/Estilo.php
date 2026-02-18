<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cerveza;

class Estilo extends Model
{
    use HasFactory;

    // Campos que se pueden llenar de forma masiva
    protected $fillable = [
        'nombre',
        'tipo_fermentacion',
        'descripcion',
    ];

    // Relación: un estilo puede tener muchas cervezas
    public function cervezas()
    {
        return $this->hasMany(Cerveza::class, 'estilo_id');
    }
}

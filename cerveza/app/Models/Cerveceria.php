<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cerveza;

class Cerveceria extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'cervecerias';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'pais_ciudad',
        'latitud',
        'longitud',
        'anio_fundacion',
        'descripcion',
        'sitio_web',
    ];

    // Relación: una cervecería tiene muchas cervezas
    public function cervezas()
    {
        return $this->hasMany(Cerveza::class, 'cerveceria_id');
    }
}

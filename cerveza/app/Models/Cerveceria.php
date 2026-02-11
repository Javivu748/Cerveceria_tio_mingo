<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cerveza;

class Cerveceria extends Model
{
    use HasFactory;

    // Usar nombre de tabla sin acento para evitar problemas
    protected $table = 'cervecerias';

    /**
     * Campos asignables masivamente
     */
    protected $fillable = [
        'nombre',
        'pais_ciudad',
        'anio_fundacion',
        'descripcion',
        'sitio_web',
    ];

    /**
     * =========================
     * Relaciones
     * =========================
     */

    // 1:N → Una cervecería puede producir muchas cervezas
    public function cervezas()
    {
        return $this->hasMany(Cerveza::class, 'cerveceria_id');
    }
}

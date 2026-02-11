<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cerveza;

class Estilo extends Model
{
    use HasFactory;

    /**
     * Campos asignables masivamente
     */
    protected $fillable = [
        'nombre',
        'tipo_fermentacion',
        'descripcion',
    ];

    /**
     * =========================
     * Relaciones
     * =========================
     */

    // 1:N → Un estilo puede tener muchas cervezas
    public function cervezas()
    {
        return $this->hasMany(Cerveza::class, 'estilo_id');
    }
}

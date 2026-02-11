<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cerveza;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    /**
     * Campos asignables masivamente
     */
    protected $fillable = [
        'nombre_distribuidora',
        'contacto',
        'telefono',
        'plazo_entrega_estimado'
    ];

    /**
     * =========================
     * Relaciones
     * =========================
     */

    // N:M → Un proveedor puede distribuir muchas cervezas
    public function cervezas()
    {
        return $this->belongsToMany(
            Cerveza::class,
            'cerveza_proveedor',
            'proveedor_id',
            'cerveza_id'
        );
        // Si la tabla pivote tiene timestamps:
        // ->withTimestamps();
    }
}

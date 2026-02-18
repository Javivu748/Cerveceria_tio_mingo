<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cerveza;

class Proveedor extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'proveedores';

    // Campos que se pueden llenar de forma masiva
    protected $fillable = [
        'nombre_distribuidora',
        'contacto',
        'telefono',
        'plazo_entrega_estimado'
    ];

    // Relación: un proveedor puede distribuir muchas cervezas (muchos a muchos)
    public function cervezas()
    {
        return $this->belongsToMany(
            Cerveza::class,
            'cerveza_proveedor',
            'proveedor_id',
            'cerveza_id'
        );
    }
}

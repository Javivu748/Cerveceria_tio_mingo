
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre_distribuidora',
        'contacto',
        'telefono',
        'plazo_entrega_estimado'
    ];

    // Relación muchos a muchos con Cervezas
    public function cervezas()
    {
        return $this->belongsToMany(Cerveza::class, 'cerveza_proveedor');
    }
}
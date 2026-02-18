<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proveedor;
use App\Models\Cerveceria;
use App\Models\Pedido;
use App\Models\Resenia;
use App\Models\Estilo;

class Cerveza extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'cervezas';

    // Campos que podemos rellenar de forma masiva
    protected $fillable = [
        'name',
        'estilo_id',
        'cerveceria_id',
        'formato',
        'capacidad',
        'imagen_url',
        'precio_eur',
    ];

    // Convertimos automáticamente estos campos al tipo correcto
    protected $casts = [
        'capacidad' => 'integer',
        'precio_eur' => 'float',
    ];

    // Una cerveza pertenece a un estilo
    public function estilo()
    {
        return $this->belongsTo(Estilo::class, 'estilo_id');
    }

    // Una cerveza pertenece a una cervecería
    public function cerveceria()
    {
        return $this->belongsTo(Cerveceria::class, 'cerveceria_id');
    }

    // Una cerveza puede tener muchas reseñas
    public function resenias()
    {
        return $this->hasMany(Resenia::class, 'cerveza_id');
    }

    // Una cerveza puede estar asociada a muchos proveedores
    public function proveedores()
    {
        return $this->belongsToMany(
            Proveedor::class,
            'cerveza_proveedor',
            'cerveza_id',
            'proveedor_id'
        );
    }

    // Una cerveza puede estar en muchos pedidos
    public function pedidos()
    {
        return $this->belongsToMany(
            Pedido::class,
            'cerveza_pedido',
            'cerveza_id',
            'pedido_id'
        )
        ->withPivot('cantidad')
        ->withTimestamps();
    }
}

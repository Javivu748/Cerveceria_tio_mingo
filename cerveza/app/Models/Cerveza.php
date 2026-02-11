<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Cerveceria;
use App\Models\Pedido;
use App\Models\Resenia;
use App\Models\Estilo;
use App\Models\Local;

class Cerveza extends Model
{
    use HasFactory;

    protected $table = 'cervezas';

    /**
     * Campos asignables masivamente
     */
    protected $fillable = [
        'name',
        'estilo_id',
        'cerveceria_id', // si representa Local
        'formato',
        'capacidad',
        'imagen_url',
        'precio_eur',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'capacidad' => 'integer',
        'precio_eur' => 'float',
    ];

    /**
     * =========================
     * Relaciones
     * =========================
     */

    // N:1 → Una cerveza pertenece a un usuario

    // N:1 → Una cerveza pertenece a un estilo
    public function estilo()
    {
        return $this->belongsTo(Estilo::class, 'estilo_id');
    }

    public function cerveceria()
    {
        return $this->belongsTo(Cerveceria::class, 'cerveceria_id');
    }

    // 1:N → Una cerveza puede tener muchas reseñas
    public function resenias()
    {
        return $this->hasMany(Resenia::class, 'cerveza_id');
    }

    // N:M → Una cerveza puede tener muchos proveedores
    public function proveedores()
    {
        return $this->belongsToMany(
            Proveedor::class,
            'cerveza_proveedor',
            'cerveza_id',
            'proveedor_id'
        );
    }

    // N:M → Una cerveza puede estar en muchos pedidos
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

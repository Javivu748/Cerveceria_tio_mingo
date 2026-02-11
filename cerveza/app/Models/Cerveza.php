<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Proveedor;
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
        'nombre',
        'estilo_id',
        'cerveceria_id', // si representa Local
        'formato',
        'capacidad',
        'user_id',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'capacidad' => 'integer',
    ];

    /**
     * =========================
     * Relaciones
     * =========================
     */

    // N:1 → Una cerveza pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // N:1 → Una cerveza pertenece a un estilo
    public function estilo()
    {
        return $this->belongsTo(Estilo::class, 'estilo_id');
    }

    // N:1 → Una cerveza pertenece a un local/cervecería
    public function local()
    {
        return $this->belongsTo(Local::class, 'cerveceria_id');
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

    /**
     * =========================
     * Accesor / Helper
     * =========================
     */

    // Promedio de puntuación de todas las reseñas
    public function getPuntuacionPromedioAttribute()
    {
        return $this->resenias()->avg('puntuacion') ?? 0;
    }

    /**
     * Scope para cervezas con mayor rating
     */
    public function scopeMejorValoradas($query, $limit = 10)
    {
        return $query->with('resenias')
                     ->get()
                     ->sortByDesc(fn($c) => $c->puntuacion_promedio)
                     ->take($limit);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cerveza;

class Pedido extends Model
{
    use HasFactory;

    protected $table = "pedidos";

    /**
     * Campos asignables masivamente
     */
    protected $fillable = [
        'fecha',
        'user_id',
        'estado',
        'total',
        'metodoPago',
    ];

    /**
     * =========================
     * Relaciones
     * =========================
     */

    // N:1 → Un pedido pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // N:M → Un pedido puede tener muchas cervezas
    public function cervezas()
    {
        return $this->belongsToMany(
            Cerveza::class,
            'cerveza_pedido',
            'pedido_id',
            'cerveza_id'
        )
        ->withPivot('cantidad')
        ->withTimestamps();
    }

    /**
     * =========================
     * Scopes / Accesor opcionales
     * =========================
     */

    // Scope para pedidos recientes
    public function scopeRecientes($query)
    {
        return $query->orderBy('fecha', 'desc');
    }

    // Accesor para formato de fecha legible
    public function getFechaFormateadaAttribute()
    {
        return $this->fecha ? $this->fecha->format('d/m/Y') : null;
    }
}

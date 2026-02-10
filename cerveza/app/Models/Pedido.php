<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = "pedidos"; // coincide con la migración
    protected $fillable = [
        'fecha',
        'user_id',
        'estado',
        'total',
        'metodoPago',
    ];

    // Relación: un Pedido pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: un Pedido tiene muchas Cervezas (tabla pivote cerveza_pedido)
    public function cervezas()
    {
        return $this->belongsToMany(Cerveza::class, 'cerveza_pedido')->withPivot('cantidad')->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = "pedidos";

    protected $fillable = [
    'user_id',
    'fecha',
    'total',
    'estado',
    'metodoPago',  
    'paypal_order_id',
    'paypal_payer_id',
    'paypal_payer_email',
];

    protected $casts = [
        'fecha' => 'date',
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación uno a muchos (si usas tabla detalle_pedidos)
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }

    // Relación muchos a muchos con cervezas
    public function cervezas()
    {
        return $this->belongsToMany(
            Cerveza::class,
            'cerveza_pedido',
            'pedido_id',
            'cerveza_id'
        )->withPivot('cantidad')
         ->withTimestamps();
    }
}

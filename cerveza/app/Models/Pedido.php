<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetallePedido;
use App\Models\Cerveza;

class Pedido extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = "pedidos";

    // Campos que se pueden llenar de forma masiva
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

    // Conversión automática de tipos de datos
    protected $casts = [
        'fecha' => 'date',
    ];

    // Relación: un pedido pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: un pedido puede tener muchos detalles (detalle_pedidos)
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }

    // Relación: un pedido puede contener muchas cervezas (muchos a muchos)
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
}

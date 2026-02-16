<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    // Nombre de la tabla (importante)
    protected $table = 'detalle_pedidos';

    // Campos que se pueden llenar
    protected $fillable = [
        'pedido_id',
        'cerveza_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // Relación: Un detalle pertenece a un pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // Relación: Un detalle pertenece a una cerveza
    public function cerveza()
    {
        return $this->belongsTo(Cerveza::class);
    }
}
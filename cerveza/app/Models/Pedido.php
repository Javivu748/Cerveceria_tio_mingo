<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = "pedidos";

    protected $fillable = [
        'fecha',
        'user_id',
        'estado',
        'total',
        'metodoPago',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cervezas()
    {
        return $this->belongsToMany(
            Cerveza::class,
            'cerveza_pedido',
            'pedido_id',
            'cerveza_id'
        )->withPivot('cantidad')->withTimestamps();
    }
}

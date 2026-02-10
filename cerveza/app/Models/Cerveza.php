<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cerveza extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'estilo_id',
        'cerveceria_id',
        'formato',
        'capacidad',
        'user_id'
    ];

    // Relación con User (n cervezas pertenecen a 1 usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación muchos a muchos con Proveedores
    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class, 'cerveza_proveedor');
    }
    // Relación muchos a muchos con Pedidos
    public function pedidos()
{
    return $this->belongsToMany(Pedido::class, 'cerveza_pedido')->withPivot('cantidad')->withTimestamps();
}
}
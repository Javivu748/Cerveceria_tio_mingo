<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cerveza;
use App\Models\Pedido;

class Local extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = "local";

    // Campos que se pueden llenar de forma masiva
    protected $fillable = [
        'nombre',
        'user_id',
        'telefono',
        'email',
    ];

    // Relación: un local pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación: un local puede tener muchas cervezas
    public function cervezas()
    {
        return $this->hasMany(Cerveza::class, 'local_id');
    }

    // Relación: un local puede tener muchos pedidos a través del usuario
    public function pedidos()
    {
        return $this->hasManyThrough(
            Pedido::class,
            User::class,
            'id',
            'user_id',
            'user_id',
            'id'
        );
    }
}

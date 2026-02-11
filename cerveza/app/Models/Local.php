<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cerveza;

class Local extends Model
{
    use HasFactory;
    
    protected $table = "local"; // o 'locales' si tu migración usa plural
     
    /**
     * Campos asignables masivamente
     */
    protected $fillable = [
        'nombre',
        'user_id',
        'telefono',
        'email',
    ];

    /**
     * =========================
     * Relaciones
     * =========================
     */

    // N:1 → Un local pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 1:N → Un local puede tener muchas cervezas
    public function cervezas()
    {
        return $this->hasMany(Cerveza::class, 'local_id');
    }

    // 1:N → Un local puede tener muchos pedidos (si aplica)
    public function pedidos()
    {
        return $this->hasManyThrough(
            Pedido::class,
            User::class,
            'id',       // User PK
            'user_id',  // Pedido FK
            'user_id',  // Local FK
            'id'        // User PK en relación
        );
    }
}

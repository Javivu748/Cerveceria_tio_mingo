<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Local;
use App\Models\Pedido;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    // Campos que se pueden llenar de forma masiva
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'password',
        'role',
        'latitude',
        'longitude',
        'address',    
    ];

    // Relación: un usuario puede tener un local (1 a 1)
    public function local()
    {
        return $this->hasOne(Local::class, 'user_id');
    }

    // Relación: un usuario puede tener muchos pedidos (1 a N)
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'user_id');
    }

    // Notificación: enviar verificación de email
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    // Notificación: enviar recuperación de contraseña
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // Campos ocultos al serializar el modelo
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Conversión de tipos de atributos
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

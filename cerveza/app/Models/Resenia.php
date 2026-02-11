<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Resenia extends Model
{
    use HasFactory;

    protected $table = "resenias";

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'cerveza_id',
        'user_id',
        'puntuacion',
        'comentario',
        'fecha',
        'nombre_publico',      // NUEVO: para guardar el nombre del formulario
        'email_publico',       // NUEVO: para guardar el email del formulario
    ];

    // Castear los campos a sus tipos correctos
    protected $casts = [
        'fecha' => 'date',
        'puntuacion' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relación: una reseña pertenece a una cerveza (N:1)
    public function cerveza()
    {
        return $this->belongsTo(Cerveza::class);
    }

    // Relación: una reseña pertenece a un usuario (N:1)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para obtener reseñas más recientes
     */
    public function scopeMasRecientes($query)
    {
        return $query->orderBy('fecha', 'desc')
                    ->orderBy('created_at', 'desc');
    }

    /**
     * Accessor para obtener la fecha en formato legible
     */
    public function getFechaFormateadaAttribute()
    {
        return Carbon::parse($this->fecha)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
    }

    /**
     * Obtener el nombre a mostrar (prioriza nombre_publico sobre user.name)
     */
    public function getNombreMostrarAttribute()
    {
        if ($this->nombre_publico) {
            return $this->nombre_publico;
        }
        
        if ($this->user) {
            return $this->user->name;
        }
        
        return 'Usuario Anónimo';
    }

    /**
     * Método para validar antes de guardar
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($resenia) {
            // Si no se proporciona fecha, usar la fecha actual
            if (!$resenia->fecha) {
                $resenia->fecha = now()->format('Y-m-d');
            }
        });
    }
}
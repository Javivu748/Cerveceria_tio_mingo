<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Cerveza;
use App\Models\User;

class Resenia extends Model
{
    use HasFactory;

    protected $table = "resenias";

    /**
     * Campos asignables masivamente
     */
    protected $fillable = [
        'cerveza_id',
        'user_id',
        'puntuacion',
        'comentario',
        'fecha',
        'nombre_publico',
        'email_publico',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'fecha' => 'date',
        'puntuacion' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * =========================
     * Relaciones
     * =========================
     */

    // N:1 → Una reseña pertenece a una cerveza
    public function cerveza()
    {
        return $this->belongsTo(Cerveza::class, 'cerveza_id');
    }

    // N:1 → Una reseña pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * =========================
     * Scopes
     * =========================
     */

    public function scopeMasRecientes($query)
    {
        return $query->orderBy('fecha', 'desc')
                     ->orderBy('created_at', 'desc');
    }

    /**
     * =========================
     * Accessors
     * =========================
     */

    // Fecha formateada en español
    public function getFechaFormateadaAttribute()
    {
        if (!$this->fecha) {
            return null;
        }

        return Carbon::parse($this->fecha)
            ->locale('es')
            ->isoFormat('D [de] MMMM [de] YYYY');
    }

    // Nombre a mostrar
    public function getNombreMostrarAttribute()
    {
        if ($this->nombre_publico) {
            return $this->nombre_publico;
        }

        if ($this->user) {
            return $this->user->nombre; // corregido según tu modelo User
        }

        return 'Usuario Anónimo';
    }

}

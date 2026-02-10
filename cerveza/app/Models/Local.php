<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Local extends Model
{
    use HasFactory;
    
    protected $table = "local";
    protected $fillable = [
        'nombre',
        'user_id',
        'telefono',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

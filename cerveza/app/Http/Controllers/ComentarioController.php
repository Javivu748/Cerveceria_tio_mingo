<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:100',
            'puntuacion' => 'required|integer|min:1|max:10',
            'texto'      => 'required|string|max:1000',
        ]);

        Comentario::create($request->only(['nombre', 'puntuacion', 'texto']));

        return redirect()->route('home')->with('mensaje', '¡Gracias! Tu comentario ya aparece en el carrusel.');
    }
}
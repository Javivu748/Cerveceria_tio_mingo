<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Almacena un nuevo comentario enviado por un usuario.
     * 
     * Valida los datos, lo guarda en la base de datos y devuelve un mensaje de agradecimiento.
     */
    public function store(Request $request)
    {
        // Validamos los datos del formulario
        $validated = $request->validate([
            'nombre'     => 'required|string|max:100',
            'puntuacion' => 'required|integer|min:1|max:10',
            'texto'      => 'required|string|max:1000',
        ]);

        // Creamos el comentario en la base de datos
        Comentario::create($validated);

        // Redirigimos al home con un mensaje de éxito
        return redirect()
            ->route('home')
            ->with('mensaje', '¡Gracias! Tu comentario ya aparece en el carrusel.');
    }
}

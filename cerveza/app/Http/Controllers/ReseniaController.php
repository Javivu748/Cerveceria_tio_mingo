<?php

namespace App\Http\Controllers;

use App\Models\Resenia;
use Illuminate\Http\Request;

class ReseniaController extends Controller
{
    // Muestra todas las reseñas con su usuario y cerveza
    public function index()
    {
        return Resenia::with('user', 'cerveza')->get();
    }


    // Crea una nueva reseña
    public function store(Request $request)
    {
        $resenia = Resenia::create($request->only([
            'cerveza_id',
            'user_id',
            'puntuacion',
            'comentario',
            'fecha'
        ]));

        return $resenia->load('user', 'cerveza');
    }

    // Actualiza una reseña existente
    public function update(Request $request, Resenia $resenia)
    {
        $resenia->update($request->only([
            'puntuacion',
            'comentario',
            'fecha'
        ]));

        return $resenia->load('user', 'cerveza');
    }

    // Elimina una reseña
    public function destroy(Resenia $resenia)
    {
        $resenia->delete();

        return response()->json([
            'message' => 'Reseña eliminada correctamente'
        ]);
    }
}

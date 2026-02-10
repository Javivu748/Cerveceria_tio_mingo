<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Mostrar todos los pedidos
    public function index()
    {
        return Pedido::with('cervezas', 'user')->get();
    }

    // Mostrar un pedido
    public function show(Pedido $pedido)
    {
        return $pedido->load('cervezas', 'user');
    }

    // Crear un pedido nuevo
    public function store(Request $request)
    {
        $pedido = Pedido::create($request->only(['fecha', 'user_id', 'estado', 'total', 'metodoPago']));

        if ($request->has('cervezas')) {
            foreach ($request->cervezas as $c) {
                $pedido->cervezas()->attach($c['id'], ['cantidad' => $c['cantidad'] ?? 1]);
            }
        }

        return $pedido->load('cervezas', 'user');
    }

    // Actualizar pedido
    public function update(Request $request, Pedido $pedido)
    {
        $pedido->update($request->only(['fecha', 'estado', 'total', 'metodoPago']));

        if ($request->has('cervezas')) {
            $pedido->cervezas()->sync(collect($request->cervezas)->mapWithKeys(function($c){
                return [$c['id'] => ['cantidad' => $c['cantidad'] ?? 1]];
            })->toArray());
        }

        return $pedido->load('cervezas', 'user');
    }

    // Eliminar pedido
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return response()->json(['message' => 'Pedido eliminado correctamente']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cerveza;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Mostrar SOLO los pedidos del usuario autenticado
     */
    public function index()
    {
        $pedidos = auth()->user()
            ->pedidos()
            ->with('cervezas')
            ->orderBy('fecha', 'desc')
            ->get();

        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $cervezas = Cerveza::all();

        return view('pedidos.create', compact('cervezas'));
    }

    /**
     * Guardar pedido
     */
    public function store(Request $request)
    {
        $request->validate([
            'cervezas' => 'required|array',
            'cervezas.*.cantidad' => 'required|integer|min:1'
        ]);

        $total = 0;
        $cervezasSeleccionadas = [];

        foreach ($request->cervezas as $cerveza_id => $data) {

            $cerveza = Cerveza::findOrFail($cerveza_id);

            $cantidad = $data['cantidad'];

            $subtotal = $cerveza->precio * $cantidad;

            $total += $subtotal;

            $cervezasSeleccionadas[$cerveza_id] = [
                'cantidad' => $cantidad
            ];
        }

        $pedido = Pedido::create([
            'fecha' => now(),
            'estado' => 'pendiente',
            'total' => $total,
            'metodoPago' => 'pendiente'
        ]);

        $pedido->user()->associate(auth()->user());
        $pedido->save();

        $pedido->cervezas()->attach($cervezasSeleccionadas);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido realizado correctamente');
    }

    /**
     * Eliminar pedido
     */
    public function destroy(Pedido $pedido)
    {
        if ($pedido->user_id !== auth()->id()) {
            abort(403);
        }

        $pedido->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido eliminado correctamente');
    }
}

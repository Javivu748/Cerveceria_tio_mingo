<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cerveza;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Mostrar todos los pedidos del usuario
     */
    public function index()
    {
        $pedidos = Pedido::where('user_id', auth()->id())
                         ->orderBy('fecha', 'desc')
                         ->get();

        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Mostrar formulario de crear pedido
     */
    public function create()
    {
        $cervezas = Cerveza::all();
        return view('pedidos.create', compact('cervezas'));
    }

    /**
     * Guardar pedido pagado vía PayPal
     */
    public function storePayPal(array $pedidoTemp, string $orderId, array $result)
    {
        // Crear el pedido en la base de datos
        $pedido = Pedido::create([
            'user_id' => auth()->id(),
            'fecha' => now(),
            'total' => $pedidoTemp['total'],
            'estado' => 'completado',
            'metodoPago' => 'paypal',
            'paypal_order_id' => $orderId,
            'paypal_payer_id' => $result['payer']['payer_id'] ?? null,
            'paypal_payer_email' => $result['payer']['email_address'] ?? null,
        ]);

        // Agregar detalles de cervezas (si existe)
        if (!empty($pedidoTemp['cervezas'])) {
            foreach ($pedidoTemp['cervezas'] as $cervezaId => $data) {
                $pedido->cervezas()->attach($cervezaId, [
                    'cantidad' => $data['cantidad']
                ]);
            }
        }

        return $pedido;
    }

    /**
     * Obtener detalle de un pedido (AJAX)
     */
    public function detalle($id)
    {
        $pedido = Pedido::with('detalles.cerveza')
                        ->where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        return response()->json([
            'id' => $pedido->id,
            'fecha' => $pedido->fecha->format('d/m/Y H:i'),
            'total' => $pedido->total,
            'estado' => ucfirst($pedido->estado),
            'paypal_order_id' => $pedido->paypal_order_id,
            'detalles' => $pedido->detalles->map(function($detalle) {
                return [
                    'cerveza_nombre' => $detalle->cerveza->name,
                    'cantidad' => $detalle->cantidad,
                    'precio_unitario' => $detalle->precio_unitario,
                    'subtotal' => $detalle->subtotal,
                ];
            })
        ]);
    }

    /**
     * Cancelar (eliminar) un pedido
     */
    public function destroy($id)
    {
        $pedido = Pedido::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        // Eliminar detalles primero
        $pedido->detalles()->delete();

        // Eliminar pedido
        $pedido->delete();

        return redirect()->route('pedidos.index')
                        ->with('success', 'Pedido cancelado correctamente.');
    }
}

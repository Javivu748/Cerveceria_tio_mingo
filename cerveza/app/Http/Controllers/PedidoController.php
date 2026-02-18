<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cerveza;

class PedidoController extends Controller
{
    /**
     * Mostrar todos los pedidos del usuario autenticado.
     */
    public function index()
    {
        $userId = auth()->id();

        $pedidos = Pedido::where('user_id', $userId)
                         ->orderBy('fecha', 'desc')
                         ->get();

        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Mostrar el formulario para crear un nuevo pedido.
     */
    public function create()
    {
        $cervezas = Cerveza::all(); // Obtenemos todas las cervezas disponibles
        return view('pedidos.create', compact('cervezas'));
    }

    /**
     * Guardar un pedido pagado vía PayPal en la base de datos.
     *
     * @param array $pedidoTemp Datos temporales del pedido (sesión)
     * @param string $orderId ID de la orden en PayPal
     * @param array $result Datos devueltos por PayPal
     * @return Pedido
     */
    public function storePayPal(array $pedidoTemp, string $orderId, array $result)
    {
        // Crear el pedido principal
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

        // Guardar los detalles de cada cerveza en el pedido
        if (!empty($pedidoTemp['cervezas'])) {
            foreach ($pedidoTemp['cervezas'] as $cervezaId => $data) {
                $pedido->cervezas()->attach($cervezaId, [
                    'cantidad' => $data['cantidad'],
                    'precio_unitario' => $data['cerveza']->precio_eur ?? 0,
                    'subtotal' => $data['subtotal'] ?? 0,
                ]);
            }
        }

        return $pedido;
    }

    /**
     * Obtener detalle de un pedido (para AJAX/JSON).
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detalle($id)
    {
        $pedido = Pedido::with('detalles.cerveza')
                        ->where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        $detalles = $pedido->detalles->map(function ($detalle) {
            return [
                'cerveza_nombre'  => $detalle->cerveza->name,
                'cantidad'        => $detalle->cantidad,
                'precio_unitario' => $detalle->precio_unitario,
                'subtotal'        => $detalle->subtotal,
            ];
        });

        return response()->json([
            'id' => $pedido->id,
            'fecha' => $pedido->fecha->format('d/m/Y H:i'),
            'total' => $pedido->total,
            'estado' => ucfirst($pedido->estado),
            'paypal_order_id' => $pedido->paypal_order_id,
            'detalles' => $detalles,
        ]);
    }

    /**
     * Cancelar (eliminar) un pedido y sus detalles.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $pedido = Pedido::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        // Primero eliminamos los detalles asociados
        $pedido->detalles()->delete();

        // Luego eliminamos el pedido principal
        $pedido->delete();

        return redirect()->route('pedidos.index')
                        ->with('success', 'Pedido cancelado correctamente.');
    }
}

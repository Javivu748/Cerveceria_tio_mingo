<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Cerveza;
use App\Services\TelegramService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    protected $telegram;

    public function __construct(TelegramService $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Crear el pago en PayPal.
     * Valida los productos seleccionados, genera la orden y redirige al checkout.
     */
    public function createPayment(Request $request)
    {
        try {
            // Validamos que se envíen cervezas con cantidades
            $request->validate([
                'cervezas' => 'required|array',
                'cervezas.*.cantidad' => 'integer|min:0',
            ]);

            $cervezasSeleccionadas = [];
            $total = 0;

            // Recorremos las cervezas y calculamos subtotales
            foreach ($request->cervezas as $cervezaId => $data) {
                $cantidad = (int) ($data['cantidad'] ?? 0);

                if ($cantidad > 0) {
                    $cerveza = Cerveza::findOrFail($cervezaId);

                    $subtotal = $cerveza->precio_eur * $cantidad;

                    $cervezasSeleccionadas[] = [
                        'cerveza'  => $cerveza,
                        'cantidad' => $cantidad,
                        'subtotal' => $subtotal,
                    ];

                    $total += $subtotal;
                }
            }

            // Si no hay productos seleccionados
            if (empty($cervezasSeleccionadas)) {
                return redirect()->back()->with('error', 'Debes seleccionar al menos un producto.');
            }

            // Guardamos los datos del pedido temporal en sesión
            session([
                'pedido_temp' => [
                    'cervezas' => $cervezasSeleccionadas,
                    'total'    => $total,
                ]
            ]);

            // Configuramos PayPal
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $accessToken = $provider->getAccessToken();

            if (!$accessToken) {
                throw new \Exception('No se pudo obtener el token de PayPal');
            }

            // Preparamos los items para PayPal
            $items = [];
            foreach ($cervezasSeleccionadas as $item) {
                $items[] = [
                    'name'     => $item['cerveza']->name,
                    'quantity' => $item['cantidad'],
                    'unit_amount' => [
                        'currency_code' => 'EUR',
                        'value'         => number_format($item['cerveza']->precio_eur, 2, '.', '')
                    ]
                ];
            }

            // Creamos la orden en PayPal
            $order = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url"   => route('paypal.success'),
                    "cancel_url"   => route('paypal.cancel'),
                    "brand_name"   => "Cervecería Tío Mingo",
                    "locale"       => "es-ES",
                    "landing_page" => "BILLING",
                    "user_action"  => "PAY_NOW"
                ],
                "purchase_units" => [[
                    "reference_id" => "CERVECERIA_" . time(),
                    "description"  => "Pedido de cervezas artesanales",
                    "amount" => [
                        "currency_code" => "EUR",
                        "value"         => number_format($total, 2, '.', ''),
                        "breakdown"     => [
                            "item_total" => [
                                "currency_code" => "EUR",
                                "value"         => number_format($total, 2, '.', '')
                            ]
                        ]
                    ],
                    "items" => $items
                ]]
            ]);

            // Redirigir al usuario al checkout de PayPal
            if (isset($order['id'])) {
                session(['paypal_order_id' => $order['id']]);

                foreach ($order['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }

        } catch (\Exception $e) {
            Log::error('Error en PayPal createPayment', [
                'mensaje' => $e->getMessage(),
                'archivo' => $e->getFile(),
                'linea'   => $e->getLine(),
            ]);

            if (config('app.debug')) {
                dd([
                    'error'   => $e->getMessage(),
                    'archivo' => $e->getFile(),
                    'linea'   => $e->getLine(),
                ]);
            }

            return redirect()->back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    /**
     * Captura el pago exitoso y guarda el pedido en la base de datos.
     */
    public function paymentSuccess(Request $request)
    {
        try {
            $orderId = session('paypal_order_id');

            if (!$orderId) {
                return redirect()->route('pedidos.index')
                                 ->with('error', 'No se encontró la orden.');
            }

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $result = $provider->capturePaymentOrder($orderId);

            if (isset($result['status']) && $result['status'] === 'COMPLETED') {
                $pedidoTemp = session('pedido_temp');

                if (!$pedidoTemp) {
                    throw new \Exception('No se encontraron datos del pedido');
                }

                DB::beginTransaction();

                try {
                    // Guardamos el pedido principal
                    $pedido = Pedido::create([
                        'user_id'            => Auth::id(),
                        'fecha'              => now(),
                        'total'              => $pedidoTemp['total'],
                        'estado'             => 'completado',
                        'metodoPago'         => 'paypal',
                        'paypal_order_id'    => $orderId,
                        'paypal_payer_id'    => $result['payer']['payer_id'] ?? null,
                        'paypal_payer_email' => $result['payer']['email_address'] ?? null,
                    ]);

                    // Guardamos los detalles del pedido
                    foreach ($pedidoTemp['cervezas'] as $item) {
                        DetallePedido::create([
                            'pedido_id'       => $pedido->id,
                            'cerveza_id'      => $item['cerveza']->id,
                            'cantidad'        => $item['cantidad'],
                            'precio_unitario' => $item['cerveza']->precio_eur,
                            'subtotal'        => $item['subtotal'],
                        ]);
                    }

                    DB::commit();

                    // Limpiamos la sesión
                    session()->forget(['pedido_temp', 'paypal_order_id']);

                    // Notificar al admin vía Telegram
                    $this->telegram->notifyNewPurchase($pedido, Auth::user());

                    return view('paypal.success', [
                        'pedido'     => $pedido,
                        'paypalData' => $result
                    ]);

                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
            }

            throw new \Exception('El pago no se completó correctamente');

        } catch (\Exception $e) {
            Log::error('Error en PayPal paymentSuccess: ' . $e->getMessage());
            return redirect()->route('pedidos.index')
                             ->with('error', 'Error al confirmar el pago: ' . $e->getMessage());
        }
    }

    /**
     * Cancelar el pago y limpiar la sesión.
     */
    public function paymentCancel()
    {
        session()->forget(['pedido_temp', 'paypal_order_id']);

        return redirect()->route('pedidos.index')
                         ->with('warning', 'Has cancelado el pago.');
    }
}

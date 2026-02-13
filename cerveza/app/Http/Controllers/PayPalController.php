<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Cerveza;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    /**
     * Crear el pago en PayPal
     */
    public function createPayment(Request $request)
    {
        try {
            // 1. Validar que haya productos
            $request->validate([
                'cervezas' => 'required|array',
                'cervezas.*.cantidad' => 'integer|min:0',
            ]);

            // 2. Procesar cervezas seleccionadas
            $cervezasSeleccionadas = [];
            $total = 0;

            foreach ($request->cervezas as $cervezaId => $data) {
                $cantidad = (int) ($data['cantidad'] ?? 0);
                
                if ($cantidad > 0) {
                    $cerveza = Cerveza::findOrFail($cervezaId);
                    
                    $cervezasSeleccionadas[] = [
                        'cerveza' => $cerveza,
                        'cantidad' => $cantidad,
                        'subtotal' => $cerveza->precio_eur * $cantidad,
                    ];
                    
                    $total += $cerveza->precio_eur * $cantidad;
                }
            }

            // 3. Verificar que hay productos
            if (empty($cervezasSeleccionadas)) {
                return redirect()->back()->with('error', 'Debes seleccionar al menos un producto.');
            }

            // 4. Guardar en sesión
            session([
                'pedido_temp' => [
                    'cervezas' => $cervezasSeleccionadas,
                    'total' => $total,
                ]
            ]);

            // 5. Configurar PayPal
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $accessToken = $provider->getAccessToken();

            if (!$accessToken) {
                throw new \Exception('No se pudo obtener el token de PayPal');
            }

            // 6. Crear items para PayPal
            $items = [];
            foreach ($cervezasSeleccionadas as $item) {
                $items[] = [
                    'name' => $item['cerveza']->name,
                    'quantity' => $item['cantidad'],
                    'unit_amount' => [
                        'currency_code' => 'EUR',
                        'value' => number_format($item['cerveza']->precio_eur, 2, '.', '')
                    ]
                ];
            }

            // 7. Crear orden en PayPal
            $order = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.success'),
                    "cancel_url" => route('paypal.cancel'),
                    "brand_name" => "Cervecería Tío Mingo",
                    "locale" => "es-ES",
                    "landing_page" => "BILLING",
                    "user_action" => "PAY_NOW"
                ],
                "purchase_units" => [
                    [
                        "reference_id" => "CERVECERIA_" . time(),
                        "description" => "Pedido de cervezas artesanales",
                        "amount" => [
                            "currency_code" => "EUR",
                            "value" => number_format($total, 2, '.', ''),
                            "breakdown" => [
                                "item_total" => [
                                    "currency_code" => "EUR",
                                    "value" => number_format($total, 2, '.', '')
                                ]
                            ]
                        ],
                        "items" => $items
                    ]
                ]
            ]);

            // 8. Verificar orden creada
            if (isset($order['id']) && $order['id'] != null) {
                session(['paypal_order_id' => $order['id']]);
                
                foreach ($order['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }

            throw new \Exception('No se pudo crear la orden en PayPal');

        } catch (\Exception $e) {
            Log::error('Error en PayPal createPayment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    /**
     * Pago exitoso - Capturar y guardar
     */
    public function paymentSuccess(Request $request)
    {
        try {
            $orderId = session('paypal_order_id');
            
            if (!$orderId) {
                return redirect()->route('pedidos.index')->with('error', 'No se encontró la orden.');
            }

            // Configurar PayPal
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            // Capturar el pago
            $result = $provider->capturePaymentOrder($orderId);

            if (isset($result['status']) && $result['status'] == 'COMPLETED') {
                
                $pedidoTemp = session('pedido_temp');
                
                if (!$pedidoTemp) {
                    throw new \Exception('No se encontraron datos del pedido');
                }

                // Guardar en base de datos
                DB::beginTransaction();
                
                try {
                    // Crear pedido
                    $pedido = Pedido::create([
                        'user_id' => auth()->id(),
                        'fecha' => now(),
                        'total' => $pedidoTemp['total'],
                        'estado' => 'completado',
                        'metodoPago' => 'paypal',              // ← LÍNEA AÑADIDA
                        'paypal_order_id' => $orderId,
                        'paypal_payer_id' => $result['payer']['payer_id'] ?? null,
                        'paypal_payer_email' => $result['payer']['email_address'] ?? null,
                    ]);

                    // Crear detalles
                    foreach ($pedidoTemp['cervezas'] as $item) {
                        DetallePedido::create([
                            'pedido_id' => $pedido->id,
                            'cerveza_id' => $item['cerveza']->id,
                            'cantidad' => $item['cantidad'],
                            'precio_unitario' => $item['cerveza']->precio_eur,
                            'subtotal' => $item['subtotal'],
                        ]);
                    }

                    DB::commit();

                    // Limpiar sesión
                    session()->forget(['pedido_temp', 'paypal_order_id']);

                    // IMPORTANTE: Mostrar vista de éxito
                    return view('paypal.success', [
                        'pedido' => $pedido,
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
            return redirect()->route('pedidos.index')->with('error', 'Error al confirmar el pago: ' . $e->getMessage());
        }
    }

    /**
     * Pago cancelado
     */
    public function paymentCancel()
    {
        session()->forget(['pedido_temp', 'paypal_order_id']);
        return redirect()->route('pedidos.index')->with('warning', 'Has cancelado el pago.');
    }
}
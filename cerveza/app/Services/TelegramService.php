<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $botToken;
    protected $adminChatId;
    protected $baseUrl;

    public function __construct()
    {
        $this->botToken   = config('services.telegram.bot_token');
        $this->adminChatId = config('services.telegram.admin_chat_id');
        $this->baseUrl    = "https://api.telegram.org/bot{$this->botToken}";
    }

    /**
     * Método base para enviar mensajes
     */
    public function sendMessage(string $message, ?string $chatId = null)
    {
        try {
            $url  = "{$this->baseUrl}/sendMessage";
            $data = [
                'chat_id'    => $chatId ?? $this->adminChatId,
                'text'       => $message,
                'parse_mode' => 'HTML'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 200) {
                $result = json_decode($response, true);
                return isset($result['ok']) && $result['ok'] === true;
            }

            Log::error('Error Telegram HTTP: ' . $httpCode);
            return false;

        } catch (\Exception $e) {
            Log::error('Error Telegram: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Mensaje de prueba
     */
    public function sendTestMessage()
    {
        $message  = "━━━━━━━━━━━━━━━━━━\n";
        $message .= "🚨 <b>COMUNICADO OFICIAL</b> 🚨\n";
        $message .= "━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "👤 Se ha confirmado que:\n";
        $message .= "➡️ David es feo 😂\n\n";
        $message .= "🎭 <i>Este mensaje es una broma</i>\n";
        $message .= "💚 En realidad todos somos hermosos\n\n";
        $message .= "━━━━━━━━━━━━━━━━━━\n";
        $message .= "🕒 " . now()->format('d/m/Y H:i:s') . "\n";
        $message .= "━━━━━━━━━━━━━━━━━━";

        return $this->sendMessage($message);
    }

    /**
     * Notificar nueva cerveza al admin
     */
    public function notifyNewBeer($cerveza)
    {
        $message  = "🍺 <b>¡NUEVA CERVEZA AGREGADA!</b>\n\n";
        $message .= "🏷️ <b>Nombre:</b> {$cerveza->name}\n";
        $message .= "🍾 <b>Formato:</b> {$cerveza->formato}\n";
        $message .= "📏 <b>Capacidad:</b> {$cerveza->capacidad} ml\n";
        $message .= "💰 <b>Precio:</b> €" . number_format($cerveza->precio_eur, 2) . "\n";

        if ($cerveza->cerveceria) {
            $message .= "🏭 <b>Cervecería:</b> {$cerveza->cerveceria->nombre}\n";
        }
        if ($cerveza->estilo) {
            $message .= "🏷️ <b>Estilo:</b> {$cerveza->estilo->nombre}\n";
        }

        $message .= "\n🕒 " . now()->format('d/m/Y H:i:s');

        return $this->sendMessage($message);
    }

    /**
     * Notificar al admin que se editó una cerveza
     */
    public function notifyBeerEdited($cerveza, array $cambios)
    {
        $message  = "✏️ <b>CERVEZA EDITADA</b>\n\n";
        $message .= "🍺 <b>Nombre:</b> {$cerveza->name}\n\n";
        $message .= "📝 <b>Cambios:</b>\n";

        foreach ($cambios as $campo => $valores) {
            $message .= "  • <b>{$campo}:</b> {$valores['antes']} → {$valores['despues']}\n";
        }

        $message .= "\n🕒 " . now()->format('d/m/Y H:i:s');

        return $this->sendMessage($message);
    }

    /**
     * Notificar oferta a un usuario (precio bajó)
     */
    public function notifyOffer($user, $cerveza, $precioAnterior)
    {
        $descuento = round((($precioAnterior - $cerveza->precio_eur) / $precioAnterior) * 100);

        $message  = "🎉 <b>¡OFERTA ESPECIAL!</b>\n\n";
        $message .= "Hola {$user->nombre}! 👋\n\n";
        $message .= "🍺 <b>{$cerveza->name}</b>\n";
        $message .= "🍾 {$cerveza->formato} · {$cerveza->capacidad}ml\n\n";
        $message .= "💰 Precio anterior: <s>€" . number_format($precioAnterior, 2) . "</s>\n";
        $message .= "🔥 <b>Nuevo precio: €" . number_format($cerveza->precio_eur, 2) . "</b>\n";
        $message .= "🎁 <b>¡{$descuento}% de descuento!</b>\n\n";
        $message .= "⏰ <b>¡No te la pierdas!</b>";

        return $this->sendMessage($message, $user->telegram_chat_id);
    }

    /**
     * Notificar a TODOS los usuarios sobre oferta
     */
    public function notifyAllUsersOffer($cerveza, $precioAnterior)
    {
        $users = \App\Models\User::whereNotNull('telegram_chat_id')
                                  ->where('receive_notifications', true)
                                  ->get();

        $count = 0;
        foreach ($users as $user) {
            if ($this->notifyOffer($user, $cerveza, $precioAnterior)) {
                $count++;
                usleep(100000);
            }
        }

        return $count;
    }

    /**
     * Notificar al admin que un usuario hizo una compra
     */
    public function notifyNewPurchase($pedido, $user)
    {
        $message  = "🛒 <b>¡NUEVA COMPRA!</b>\n\n";
        $message .= "👤 <b>Cliente:</b> {$user->nombre} {$user->apellido}\n";
        $message .= "📧 <b>Email:</b> {$user->email}\n";
        $message .= "📱 <b>Teléfono:</b> {$user->telefono}\n";
        $message .= "🆔 <b>Pedido #:</b> {$pedido->id}\n";
        $message .= "💳 <b>Pago:</b> PayPal\n";

        if ($pedido->paypal_payer_email) {
            $message .= "📩 <b>PayPal:</b> {$pedido->paypal_payer_email}\n";
        }

        $message .= "\n🍺 <b>Productos:</b>\n";

        $pedido->loadMissing('detalles.cerveza');

        foreach ($pedido->detalles as $detalle) {
            $message .= "  • {$detalle->cantidad}x {$detalle->cerveza->name}";
            $message .= " · €" . number_format($detalle->subtotal, 2) . "\n";
        }

        $message .= "\n💰 <b>Total: €" . number_format($pedido->total, 2) . "</b>\n";
        $message .= "📅 " . now()->format('d/m/Y H:i:s');

        return $this->sendMessage($message);
    }
}
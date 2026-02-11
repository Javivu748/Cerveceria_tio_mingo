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
        $this->botToken = config('services.telegram.bot_token');
        $this->adminChatId = config('services.telegram.admin_chat_id');
        $this->baseUrl = "https://api.telegram.org/bot{$this->botToken}";
    }

    /**
     * Enviar mensaje a Telegram usando cURL
     */
    public function sendMessage(string $message, ?string $chatId = null)
    {
        try {
            $url = "{$this->baseUrl}/sendMessage";
            
            $data = [
                'chat_id' => $chatId ?? $this->adminChatId,
                'text' => $message,
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
     * Método de prueba
     */
    public function sendTestMessage()
    {
    $message = "━━━━━━━━━━━━━━━━━━\n";
    $message .= "🚨 <b>COMUNICADO OFICIAL</b> 🚨\n";
    $message .= "━━━━━━━━━━━━━━━━━━\n\n";
    
    $message .= "📢 <b>NOTICIA DE ÚLTIMA HORA:</b>\n\n";
    
    $message .= "👤 Se ha confirmado que:\n";
    $message .= "➡️ David es feo 😂\n\n";
    
    $message .= "📊 <b>Estadísticas:</b>\n";
    $message .= "• Nivel de fealdad: 📈 100%\n";
    $message .= "• Confirmaciones: ✅ Todas\n";
    $message .= "• Opinión popular: 😅 Unánime\n\n";
    
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
    public function notifyNewBeer($beer)
    {
        $message = "🍺 <b>¡NUEVA CERVEZA AGREGADA!</b>\n\n";
        $message .= "🏷️ <b>Nombre:</b> {$beer->name}\n";
        $message .= "🏭 <b>Marca:</b> {$beer->brand}\n";
        $message .= "💰 <b>Precio:</b> €" . number_format($beer->price, 2) . "\n";
        $message .= "📦 <b>Stock:</b> {$beer->stock} unidades\n";
        
        if (isset($beer->volume)) {
            $message .= "🍾 <b>Volumen:</b> {$beer->volume} ml\n";
        }
        
        if (isset($beer->alcohol_percentage)) {
            $message .= "🌡️ <b>Alcohol:</b> {$beer->alcohol_percentage}%\n";
        }
        
        $message .= "\n🕒 " . now()->format('d/m/Y H:i:s');

        return $this->sendMessage($message);
    }

    /**
     * Notificar oferta a un usuario
     */
    public function notifyOffer($user, $beer, $discount)
    {
        $originalPrice = $beer->price;
        $offerPrice = $originalPrice - ($originalPrice * $discount / 100);

        $message = "🎉 <b>¡OFERTA ESPECIAL!</b>\n\n";
        $message .= "Hola {$user->name}! 👋\n\n";
        $message .= "🍺 <b>{$beer->name}</b>\n";
        
        if (isset($beer->brand)) {
            $message .= "🏭 {$beer->brand}\n\n";
        }
        
        $message .= "💰 Precio normal: <s>€" . number_format($originalPrice, 2) . "</s>\n";
        $message .= "🔥 <b>Precio oferta: €" . number_format($offerPrice, 2) . "</b>\n";
        $message .= "🎁 <b>¡{$discount}% de descuento!</b>\n\n";
        $message .= "⏰ <b>Oferta limitada - ¡No te la pierdas!</b>";

        return $this->sendMessage($message, $user->telegram_chat_id);
    }

    /**
     * Notificar a TODOS los usuarios sobre una oferta
     */
    public function notifyAllUsersOffer($beer, $discount)
    {
        $users = \App\Models\User::whereNotNull('telegram_chat_id')
                                  ->where('receive_notifications', true)
                                  ->get();

        $successCount = 0;
        foreach ($users as $user) {
            if ($this->notifyOffer($user, $beer, $discount)) {
                $successCount++;
                usleep(100000); // 0.1 segundos de pausa
            }
        }

        return $successCount;
    }
}
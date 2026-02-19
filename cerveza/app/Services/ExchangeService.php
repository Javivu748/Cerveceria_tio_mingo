<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ExchangeService
{
    private $apiKey;
    private $apiUrl;

    // Inicializa la clase con la URL y la API key desde config
    public function __construct()
    {
        $this->apiKey = config('services.exchange_rate.key');
        $this->apiUrl = config('services.exchange_rate.url');
    }

    // Obtiene las tasas de cambio actuales
    public function getRates($base = 'EUR', $symbols = null)
    {
        // Generamos una clave para cachear la respuesta
        $cacheKey = "exchange_rates_{$base}_" . ($symbols ? implode('_', $symbols) : 'all');
        
        // Guardamos en cache por 1 hora para no saturar la API
        return Cache::remember($cacheKey, 3600, function () use ($base, $symbols) {

            $params = [
                'access_key' => $this->apiKey,
            ];

            // Solo pedimos las divisas que necesitamos
            if ($symbols) {
                $params['symbols'] = implode(',', $symbols);
            }

            // Hacemos la petición HTTP
            $response = Http::get($this->apiUrl . 'latest', $params);

            // Si la respuesta es correcta, la devolvemos
            if ($response->successful()) {
                return $response->json();
            }

            // Si falla la petición, lo registramos en logs
            try {
                Log::error('ExchangeService: request failed', [
                    'url' => $this->apiUrl . 'latest',
                    'params' => $params,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            } catch (\Exception $e) {
                // No hacemos nada si falla el log
            }

            return null;
        });
    }

    // Convierte un monto de una divisa a otra
    public function convert($amount, $from = 'EUR', $to = 'USD')
    {
        // Obtenemos las tasas de cambio
        $rates = $this->getRates('EUR', [$from, $to]);

        // Comprobamos que la respuesta sea válida
        if (!$rates || !isset($rates['rates']) || !is_array($rates['rates'])) {
            try {
                Log::warning('ExchangeService::convert - invalid rates response', ['response' => $rates]);
            } catch (\Exception $e) {
            }
            return null;
        }

        // Si la divisa origen es EUR
        if ($from === 'EUR') {
            return $amount * $rates['rates'][$to];
        }

        // Si la divisa destino es EUR
        if ($to === 'EUR') {
            return $amount / $rates['rates'][$from];
        }

        // Si ninguna es EUR, convertimos primero a EUR y luego a la divisa destino
        $amountInEUR = $amount / $rates['rates'][$from];
        return $amountInEUR * $rates['rates'][$to];
    }

    // Convierte y formatea un monto
    public function convertAndFormat($amount, $from = 'EUR', $to = 'USD', $decimals = 2)
    {
        $converted = $this->convert($amount, $from, $to);
        
        if ($converted === null) {
            return null;
        }

        // Devolvemos el monto con formato numérico
        return number_format($converted, $decimals, '.', ',');
    }

    // Devuelve el símbolo de la divisa
    public function getCurrencySymbol($currency)
    {
        $symbols = [
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'JPY' => '¥',
            'CNY' => '¥',
            'MXN' => '$',
            'CAD' => 'C$',
            'AUD' => 'A$',
            'CHF' => 'CHF',
            'INR' => '₹',
            'BRL' => 'R$',
            'ARS' => '$',
        ];

        // Si no hay símbolo definido, devolvemos el código
        return $symbols[$currency] ?? $currency;
    }
}

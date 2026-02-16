<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ExchangeService
{
    private $apiKey;
    private $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.exchange_rate.key');
        $this->apiUrl = config('services.exchange_rate.url');
    }

    /**
     * Obtiene las tasas de cambio actuales
     * 
     * @param string $base Divisa base (default: EUR)
     * @param array|null $symbols Divisas específicas a obtener
     * @return array|null
     */
    public function getRates($base = 'EUR', $symbols = null)
    {
        $cacheKey = "exchange_rates_{$base}_" . ($symbols ? implode('_', $symbols) : 'all');
        
        // Cachear por 1 hora para evitar exceder el límite de requests
        return Cache::remember($cacheKey, 3600, function () use ($base, $symbols) {
            $params = [
                'access_key' => $this->apiKey,
            ];

            // Nota: En el plan gratuito, la base siempre es EUR
            // Para cambiar la base necesitas el plan de pago
            if ($symbols) {
                $params['symbols'] = implode(',', $symbols);
            }

            $response = Http::get($this->apiUrl . 'latest', $params);

            if ($response->successful()) {
                return $response->json();
            }

            // Registrar el fallo para poder depurarlo desde los logs
            try {
                \Log::error('ExchangeService: request failed', [
                    'url' => $this->apiUrl . 'latest',
                    'params' => $params,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            } catch (\Exception $e) {
                // No interrumpir si falla el logger
            }

            return null;
        });
    }

    /**
     * Convierte un precio de una divisa a otra
     * 
     * @param float $amount Cantidad a convertir
     * @param string $from Divisa origen
     * @param string $to Divisa destino
     * @return float|null
     */
    public function convert($amount, $from = 'EUR', $to = 'USD')
    {
        $rates = $this->getRates('EUR', [$from, $to]);

        // Aceptar formatos distintos: comprobamos que exista el array 'rates'
        if (!$rates || !isset($rates['rates']) || !is_array($rates['rates'])) {
            // Registrar info para depuración
            try {
                \Log::warning('ExchangeService::convert - invalid rates response', ['response' => $rates]);
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

        // Para conversión entre dos divisas que no son EUR
        // Primero convertimos a EUR, luego a la divisa destino
        $amountInEUR = $amount / $rates['rates'][$from];
        return $amountInEUR * $rates['rates'][$to];
    }

    /**
     * Convierte un precio y lo formatea
     * 
     * @param float $amount Cantidad a convertir
     * @param string $from Divisa origen
     * @param string $to Divisa destino
     * @param int $decimals Número de decimales
     * @return string|null
     */
    public function convertAndFormat($amount, $from = 'EUR', $to = 'USD', $decimals = 2)
    {
        $converted = $this->convert($amount, $from, $to);
        
        if ($converted === null) {
            return null;
        }

        return number_format($converted, $decimals, '.', ',');
    }

    /**
     * Obtiene el símbolo de la divisa
     * 
     * @param string $currency Código de divisa (USD, EUR, etc.)
     * @return string
     */
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

        return $symbols[$currency] ?? $currency;
    }
}
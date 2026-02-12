<?php

namespace App\Http\Controllers;

use App\Services\ExchangeService;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    protected $currencyService;

    public function __construct(ExchangeService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Muestra las tasas de cambio actuales
     */
    public function getRates(Request $request)
    {
        $base = $request->get('base', 'EUR');
        $symbols = $request->get('symbols');

        $symbolsArray = $symbols ? explode(',', $symbols) : null;
        
        $rates = $this->currencyService->getRates($base, $symbolsArray);

        return response()->json($rates);
    }

    /**
     * Convierte un precio de una divisa a otra
     */
    public function convert(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'from' => 'required|string|size:3',
            'to' => 'required|string|size:3',
        ]);

        $amount = $request->input('amount');
        $from = strtoupper($request->input('from'));
        $to = strtoupper($request->input('to'));

        $converted = $this->currencyService->convert($amount, $from, $to);

        if ($converted === null) {
            return response()->json([
                'success' => false,
                'message' => 'Error al convertir la divisa'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'original' => [
                'amount' => $amount,
                'currency' => $from,
                'formatted' => $this->currencyService->getCurrencySymbol($from) . number_format($amount, 2)
            ],
            'converted' => [
                'amount' => $converted,
                'currency' => $to,
                'formatted' => $this->currencyService->getCurrencySymbol($to) . number_format($converted, 2)
            ]
        ]);
    }
}

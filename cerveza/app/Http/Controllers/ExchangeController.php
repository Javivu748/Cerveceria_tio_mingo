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
     * Muestra las tasas de cambio actuales.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRates(Request $request)
    {
        // Moneda base (por defecto EUR)
        $base = $request->get('base', 'EUR');

        // Divisas específicas que queremos obtener, separadas por comas
        $symbols = $request->get('symbols');
        $symbolsArray = $symbols ? explode(',', $symbols) : null;

        // Obtenemos las tasas desde el servicio
        $rates = $this->currencyService->getRates($base, $symbolsArray);

        return response()->json($rates);
    }

    /**
     * Convierte un monto de una divisa a otra.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert(Request $request)
    {
        // Validación de los datos enviados
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'from'   => 'required|string|size:3',
            'to'     => 'required|string|size:3',
        ]);

        $amount = $request->input('amount');
        $from = strtoupper($request->input('from'));
        $to   = strtoupper($request->input('to'));

        // Intentamos hacer la conversión usando el servicio
        $converted = $this->currencyService->convert($amount, $from, $to);

        // Si hubo un error en la conversión
        if ($converted === null) {
            return response()->json([
                'success' => false,
                'message' => 'Error al convertir la divisa'
            ], 400);
        }

        // Retornamos los datos originales y convertidos, con formato y símbolo
        return response()->json([
            'success' => true,
            'original' => [
                'amount'    => $amount,
                'currency'  => $from,
                'formatted' => $this->currencyService->getCurrencySymbol($from) . number_format($amount, 2)
            ],
            'converted' => [
                'amount'    => $converted,
                'currency'  => $to,
                'formatted' => $this->currencyService->getCurrencySymbol($to) . number_format($converted, 2)
            ]
        ]);
    }
}

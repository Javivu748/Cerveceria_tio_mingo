<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cerveza;
use App\Services\ExchangeService;

class CervezaController extends Controller
{
    public function cervezas()
{
    $cervezas =Cerveza::with(['estilo','cerveceria'])->get();
    return view('cerveza.cervezas', compact('cervezas'));
}
public function index()
{
    $cervezas = Cerveza::with(['estilo', 'cerveceria'])
                       ->paginate(6);

    return view('cerveza.cervezas', compact('cervezas'));
}

    /**
     * Mostrar una cerveza individual por id y opciones de cambio de divisa
     */
    public function show($id)
    {
        $cerveza = Cerveza::with(['estilo'])->findOrFail($id);

        // Lista corta de divisas disponibles para el selector en la vista
        $availableCurrencies = ['USD', 'GBP', 'JPY', 'MXN', 'CAD', 'AUD', 'CHF', 'CNY'];

        return view('cerveza.infoCerveza', compact('cerveza', 'availableCurrencies'));
    }
}

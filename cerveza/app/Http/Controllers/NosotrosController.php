<?php

namespace App\Http\Controllers;

use App\Models\Cerveceria;
use Illuminate\Http\Request;

class NosotrosController extends Controller
{
    /**
     * Muestra la página "Nosotros" con el mapa de cervecerías.
     */
    public function index()
    {
        // Obtenemos solo las cervecerías que tengan coordenadas
        $cervecerias = Cerveceria::select(
                'id', 'nombre', 'latitud', 'longitud',
                'pais_ciudad', 'anio_fundacion', 'descripcion', 'sitio_web'
            )
            ->whereNotNull('latitud')
            ->whereNotNull('longitud')
            ->get();

        // Convertimos los datos a JSON para el uso en el mapa de Google Maps
        $cerveceriasJson = $cervecerias->toJson();

        // Clave de API de Google Maps (desde .env)
        $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');

        // Retornamos la vista con los datos necesarios
        return view('nosotros.nosotros', compact('cervecerias', 'cerveceriasJson', 'googleMapsApiKey'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cerveceria;
use Illuminate\Http\Request;

class NosotrosController extends Controller
{
    /**
     * Mostrar la vista "Nosotros" con el mapa de cervecerías
     */
    public function index()
    {
        // Obtenemos las cervecerías
        $cervecerias = Cerveceria::select('id', 'nombre', 'latitud', 'longitud', 'pais_ciudad', 'anio_fundacion', 'descripcion', 'sitio_web')
            ->whereNotNull('latitud')
            ->whereNotNull('longitud')
            ->get();

        return view('nosotros.nosotros', [
            'cervecerias' => $cervecerias, 
            'cerveceriasJson' => json_encode($cervecerias),
            'googleMapsApiKey' => env('GOOGLE_MAPS_API_KEY')
        ]);
    }
}
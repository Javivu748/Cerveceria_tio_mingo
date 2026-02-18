<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    // Este componente representa la plantilla principal de la aplicación
    // Se puede usar en Blade con <x-app-layout>
    public function render(): View
    {
        // Retorna la vista 'layouts.app', que es el layout base
        return view('layouts.app');
    }
}

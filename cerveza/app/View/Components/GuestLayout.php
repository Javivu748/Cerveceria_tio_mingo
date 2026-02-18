<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    // Este componente representa la plantilla para usuarios invitados
    // Se puede usar en Blade con <x-guest-layout>
    public function render(): View
    {
        // Retorna la vista 'layouts.guest', que es el layout para invitados
        return view('layouts.guest');
    }
}

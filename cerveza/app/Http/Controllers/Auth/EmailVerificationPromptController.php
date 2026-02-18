<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Muestra el aviso para verificar el email.
     * Si el usuario ya lo verificó, lo mandamos directo al dashboard.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $user = $request->user();

        // Si el correo ya está verificado, no mostramos esta vista
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Caso contrario, mostramos la pantalla para pedir la verificación
        return view('auth.verify-email');
    }
}

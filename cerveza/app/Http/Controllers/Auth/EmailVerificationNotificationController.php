<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Envía nuevamente el correo de verificación al usuario.
     * Se usa cuando el usuario pide que le reenvíen el email.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Si el usuario ya verificó su correo, no tiene sentido reenviar nada
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Enviamos el correo de verificación otra vez
        $user->sendEmailVerificationNotification();

        // Volvemos atrás con un mensaje de estado para mostrar en la vista
        return back()->with('status', 'verification-link-sent');
    }
}

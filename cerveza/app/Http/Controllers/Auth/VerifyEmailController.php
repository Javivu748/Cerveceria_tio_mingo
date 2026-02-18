<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Marca el email del usuario autenticado como verificado.
     * 
     * Se usa cuando el usuario hace clic en el link de verificación enviado por email.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Si el usuario ya verificó su email, lo mandamos al dashboard con query ?verified=1
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        // Marcamos el email como verificado y disparamos el evento
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Redirigimos al dashboard con query ?verified=1 para indicar verificación exitosa
        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Muestra la vista para solicitar el enlace de reinicio de contraseña.
     * Aquí el usuario ingresa su email para recibir el link.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Procesa la solicitud de enlace de reinicio de contraseña.
     * Valida el email y envía el link si el usuario existe.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validamos que se haya ingresado un email válido
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $request->only('email');

        // Intentamos enviar el link de reinicio de contraseña
        $status = Password::sendResetLink($email);

        // Si se envió correctamente, mostramos un mensaje de éxito
        // Si hubo error, regresamos al formulario con los errores
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()
            ->withInput($email)
            ->withErrors(['email' => __($status)]);
    }
}

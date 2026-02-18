<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Muestra la vista para confirmar la contraseña.
     * Se usa cuando el usuario quiere hacer algo sensible
     * (por ejemplo, cambiar datos importantes).
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Valida que la contraseña ingresada sea correcta.
     * Si no coincide con la del usuario autenticado, se devuelve un error.
     */
    public function store(Request $request): RedirectResponse
    {
        // Comprobamos que la contraseña ingresada coincida con la del usuario actual
        $isValidPassword = Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ]);

        if (! $isValidPassword) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        // Guardamos el momento en que se confirmó la contraseña
        // para no pedirla de nuevo inmediatamente
        $request->session()->put('auth.password_confirmed_at', time());

        // Redirigimos al usuario a la ruta que estaba intentando acceder
        return redirect()->intended(route('dashboard', absolute: false));
    }
}

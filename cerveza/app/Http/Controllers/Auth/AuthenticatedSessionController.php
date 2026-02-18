<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra la vista del login.
     * Básicamente solo renderiza el formulario de inicio de sesión.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Procesa el login del usuario.
     * Si las credenciales son correctas, inicia sesión y regenera la sesión
     * para evitar problemas de seguridad (session fixation).
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Intenta autenticar al usuario con los datos del formulario
        $request->authenticate();

        // Regeneramos la sesión por seguridad después de iniciar sesión
        $request->session()->regenerate();

        // Redirigimos al usuario a donde intentaba entrar originalmente
        // o al dashboard si no había una ruta previa
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Cierra la sesión del usuario actual.
     * Limpia la sesión y regenera el token CSRF.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Cerramos la sesión del usuario autenticado
        Auth::guard('web')->logout();

        // Invalidamos la sesión actual para borrar datos antiguos
        $request->session()->invalidate();

        // Regeneramos el token CSRF para evitar usos indebidos
        $request->session()->regenerateToken();

        // Volvemos a la página principal
        return redirect('/');
    }
}

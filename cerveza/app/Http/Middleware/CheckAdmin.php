<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Verifica que el usuario esté autenticado y tenga rol de administrador.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificamos si el usuario está autenticado
        if (!auth()->check()) {
            // Si no, lo redirigimos al login con mensaje de error
            return redirect('/login')->with('error', 'Debes iniciar sesión');
        }

        // Verificamos que el usuario tenga rol de ADMIN
        if (auth()->user()->role !== 'ADMIN') {
            // Si no es admin, abortamos con error 403 (prohibido)
            abort(403, 'No tienes permisos de administrador');
        }

        // Si pasa ambas validaciones, dejamos continuar la solicitud
        return $next($request);
    }
}

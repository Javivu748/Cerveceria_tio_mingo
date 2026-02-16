<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión');
        }

        if (auth()->user()->role !== 'ADMIN') {
            abort(403, 'No tienes permisos de administrador');
        }

        return $next($request);
    }
}
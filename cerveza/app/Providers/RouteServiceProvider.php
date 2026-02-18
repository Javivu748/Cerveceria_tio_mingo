<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    // Ruta de inicio de la aplicación después de login
    public const HOME = '/home';

    // Configurar bindings de rutas, filtros de patrones y grupos de rutas
    public function boot()
    {
        $this->routes(function () {
            // Grupo de rutas para la API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Grupo de rutas para la web
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}

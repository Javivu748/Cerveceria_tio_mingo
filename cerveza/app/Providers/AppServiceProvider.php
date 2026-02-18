<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailVerificationNotification;
use App\Models\Cerveza;
use App\Observers\CervezaObserver;

class AppServiceProvider extends ServiceProvider
{
    // Registrar servicios de la aplicación
    public function register(): void
    {
        // Aquí puedes enlazar servicios o repositorios si hace falta
    }

    // Inicializar servicios al arrancar la aplicación
    public function boot(): void
    {
        // Escuchar el evento de registro de usuario y enviar email de verificación
        \Illuminate\Support\Facades\Event::listen(
            Registered::class,
            SendEmailVerificationNotification::class
        );

        // Registrar el observer para la clase Cerveza
        Cerveza::observe(CervezaObserver::class);
    }
}

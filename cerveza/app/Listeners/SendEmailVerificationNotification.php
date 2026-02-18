<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailVerificationNotification
{
    /**
     * Crear una nueva instancia del listener.
     *
     * Aquí normalmente se inicializan dependencias si fueran necesarias.
     */
    public function __construct()
    {
        // No se necesita configuración adicional por ahora
    }

    /**
     * Maneja el evento de usuario registrado.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;

        // Solo enviamos notificación si el email no ha sido verificado aún
        if (! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }
    }
}

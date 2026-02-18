<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class VerifyEmail extends Notification
{
    // Definir por dónde se enviará la notificación
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Construye el correo de verificación de email
    public function toMail($notifiable)
    {
        // Generamos una URL firmada temporal para verificar el email
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        // Devolvemos el mensaje de correo con asunto y vista personalizada
        return (new MailMessage)
            ->subject('Verifica que eres un usuario real')
            ->view('emails.verify', [
                'notifiable' => $notifiable,
                'verificationUrl' => $verificationUrl,
            ]);
    }
}

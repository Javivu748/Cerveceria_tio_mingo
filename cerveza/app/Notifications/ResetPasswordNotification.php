<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPasswordBase
{
    // Construye el correo que se enviará para restablecer la contraseña
    public function toMail($notifiable)
    {
        // Generamos la URL de restablecimiento con el token y el email
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        // Devolvemos el mensaje de correo con asunto y vista personalizada
        return (new MailMessage)
                    ->subject('Restablecer contraseña - Cervecería Tío Mingo')
                    ->view('emails.password_reset', [
                        'resetUrl' => $url,
                        'notifiable' => $notifiable
                    ]);
    }
}

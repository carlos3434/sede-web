<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Auth\Notifications\ResetPassword;

class ResetPasswordQueued extends ResetPassword implements ShouldQueue
{
    use Queueable;
    /* 
    public static $createUrlCallback = [self::class, 'createActionUrl'];

    public static function createActionUrl($notifiable, $token)
    {
        return url(view('auth.passwords.reset', [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]));
    }
    */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recuperar contraseña')
            ->greeting('Hola')
            ->line('Estás recibiendo este correo porque hiciste una solicitud de recuperación de contraseña para tu cuenta.')
            ->action(
                'Recuperar contraseña',
                url("password/reset?token={$this->token}&email={$notifiable->getEmailForPasswordReset()}")
            )
            ->line('Si no realizaste esta solicitud, no se requiere realizar ninguna otra acción.')
            ->salutation('Saludos, '. config('app.name'));
    }
}
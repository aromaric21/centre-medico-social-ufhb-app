<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailToUserNotification extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if ($this->data["option"] == 'activercompte') {
            return (new MailMessage)
                    ->subject("Activation de compte")
                    ->line('Bonjour, monsieur/madame '.$this->data["user"])
                    ->line("Votre compte a été créé avec succès")
                    ->line("Cliquez sur le bouton ci dessous pour activer votre compte")
                    ->line("Votre code d'activation est ".$this->data["code"])
                    ->action('Cliquez ici', url('/activation/compte'.'/'.$this->data["email"]))
                    ->line('Merci');
        }

        if ($this->data["option"] == 'resetpassword') {
            return (new MailMessage)
                    ->subject("Reinitialisation de mot de passe")
                    ->line('Bonjour, monsieur/madame '.$this->data["user"])
                    ->line("Vous etes sur le point de reinitialiser votre mot de passe")
                    ->line("Cliquez sur le bouton ci dessous pour valider la reinitialisation")
                    ->line("Votre code de reinitialisation est ".$this->data["code"])
                    ->action('Cliquez ici', url('/reinitialisation/reset-password'.'/'.$this->data["email"]))
                    ->line('Merci');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

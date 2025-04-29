<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendContactForm extends Notification
{
    use Queueable;
    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
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
     * suma ykml zyco xuhh
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Nuevo Mensaje desde Formulario de Contacto')
        ->line('Tienes un nuevo mensaje')
        ->line('Nombre:'.' '. $this->data['name'])
        ->line('Email:' .' '. $this->data['email'])
        ->line('Mensaje:' .' '. $this->data['message'])
        ->action('Responder', 'mailto:' . $this->data['email'])
            ->line('Gracias por usar mi aplicacion :)');
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

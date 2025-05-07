<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentRequested extends Notification
{
    use Queueable;
    public $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;

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
        return (new MailMessage)
        ->subject('Nueva Cita Solicitada')
        ->greeting('Hola!')
        ->line('Una nueva cita ha sido solicitada.')
        ->line('Detalles de la cita:')
        ->line('Fecha: ' . $this->appointment->date)
        ->line('Hora: ' . $this->appointment->time)
        ->line('Tratamiento: ' . $this->appointment->treatment->description)
        ->line('Fisioterapeuta: ' . $this->appointment->physio->name)
        ->action('Ver Citas', url('/my-appointments'))
        ->line('Gracias por usar nuestro servicio!');
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

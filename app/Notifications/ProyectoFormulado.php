<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProyectoFormulado extends Notification
{
    use Queueable;

    public $proyecto;
    public $usuario;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proyecto, $usuario)
    {
        $this->proyecto = $proyecto;
        $this->usuario  = $usuario;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toDatabase($notifiable)
    {
        $proyecto = array(
            "id"                => $this->proyecto->id,
            "titulo"            => $this->proyecto->titulo,
            "tipoNotificacion"  => "proyecto-enviado",
            "creado"            => date('Y-m-d H:i:s'),
            "nombreAutorNotificacion"   => $this->usuario->nombre,
            );
        return $proyecto;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

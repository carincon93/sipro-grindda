<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProyectoEvaluado extends Notification
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
         $this->proyecto    = $proyecto;
         $this->usuario     = $usuario;
     }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Tu proyecto ha sido evaluado')
                    ->line("{$this->usuario->nombre} acaba de evaluar tu proyecto.")
                    ->action('Mis proyectos', route('proyectos.index'))
                    ->line('Por favor revisa si tiene recomendaciones, Gracias!');
    }

    public function toDatabase($notifiable)
    {
        $proyecto = array(
            "id"                => $this->proyecto->id,
            "titulo"            => $this->proyecto->titulo,
            "tipoNotificacion"  => "proyecto-evaluado",
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

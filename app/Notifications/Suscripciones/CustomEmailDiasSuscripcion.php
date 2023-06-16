<?php

namespace App\Notifications\Suscripciones;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Notifications\Notification;

class CustomEmailDiasSuscripcion extends Notification

{

    use Queueable;

    protected $suscripcion;

    /**

     * Create a new notification instance.

     */

    public function __construct($suscripcion)

    {

        $this->suscripcion = $suscripcion;

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

        if ($this->suscripcion->dias_suscripcion == 1) {

            $palabraDia = 'día';

        } else {

            $palabraDia = 'días';

        }

        return (new MailMessage)

                ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))

                ->subject('⏳ Su suscripción está a punto de vencer ⏳')

                ->line('Estimado ' . $this->suscripcion->nombre_usuario . ', su suscripción finaliza en ' . $this->suscripcion->dias_suscripcion . ' ' . $palabraDia . '. ¡No pierda los beneficios de nuestra plataforma!')

                ->line('Contáctenos para más detalles y asegure la continuidad de su servicio. Quedamos a su disposición.');

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

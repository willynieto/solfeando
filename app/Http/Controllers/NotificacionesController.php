<?php

namespace App\Http\Controllers;

use App\Notifications\Suscripciones\CustomEmailDiasSuscripcion;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;

use Illuminate\Notifications\Notifiable;

class NotificacionesController extends Controller

{

    use Notifiable;

    public function notificarDiasRestantesSuscripcion($suscripciones)

    {

        foreach ($suscripciones as $suscripcion) {

            if ($suscripcion->dias_suscripcion == 5 || $suscripcion->dias_suscripcion == 3 || $suscripcion->dias_suscripcion == 1) {

                Notification::route('mail', $suscripcion->correo_usuario)

                    ->notify(new CustomEmailDiasSuscripcion($suscripcion));

            }

        }

    }

}

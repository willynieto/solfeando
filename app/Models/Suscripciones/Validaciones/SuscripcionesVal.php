<?php

namespace App\Models\Suscripciones\Validaciones;

use Illuminate\Http\Request;

class SuscripcionesVal
{
    public function validarEdicionSuscripcion(Request $request)
    {
        if ($request->renovarSuscripcion == 'si') {
            if ($request->duracion_suscripcion == 'personalizada') {
                $request->validate([
                    'instrumento_id' => 'required',
                    'duracion_suscripcion' => 'required',
                    'fecha_expiracion' => 'required',
                    'numero_operacion_pago' => 'required',
                    'metodo_pago_id' => 'required'
                ]);
            } else {
                $request->validate([
                    'instrumento_id' => 'required',
                    'duracion_suscripcion' => 'required',
                    'numero_operacion_pago' => 'required',
                    'metodo_pago_id' => 'required'
                ]);
            }
        } else {
            $request->validate([
                'estado_id' => 'required'
            ]);
        }

    }
}

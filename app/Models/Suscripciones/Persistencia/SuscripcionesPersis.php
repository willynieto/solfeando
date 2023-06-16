<?php

namespace App\Models\Suscripciones\Persistencia;

use Illuminate\Http\Request;
use App\Models\Suscripciones\Suscripcion;
use Carbon\Carbon;


class SuscripcionesPersis
{
    // Función para crear una suscripcion con duración personalizada
    public function crearSuscripcionDuracionPersonalizada(Request $request, $idUltimoUsuario)
    {
        $fechaInicioFormulario = $request->fecha_inicio;
        $fechaInicioParseada = Carbon::parse($fechaInicioFormulario);
        $fechaHoy = Carbon::now();

        if ($fechaInicioParseada->isAfter($fechaHoy)) {
            Suscripcion::create([
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_expiracion' => $request->fecha_expiracion,
                'numero_operacion_pago' => $request->numero_operacion_pago,
                'dias_suscripcion' => $this->diasRestantesSuscripcion($request->fecha_expiracion),
                'usuario_id' => $idUltimoUsuario,
                'estado_id' => 2,
                'metodo_pago_id' => $request->metodo_pago_id,
                'instrumento_id' => $request->instrumento_id
            ]);
        } else {
            Suscripcion::create([
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_expiracion' => $request->fecha_expiracion,
                'numero_operacion_pago' => $request->numero_operacion_pago,
                'dias_suscripcion' => $this->diasRestantesSuscripcion($request->fecha_expiracion),
                'usuario_id' => $idUltimoUsuario,
                'estado_id' => 1,
                'metodo_pago_id' => $request->metodo_pago_id,
                'instrumento_id' => $request->instrumento_id
            ]);
        }
    }

    //Función para crear una suscripción con duración de un mes
    public function crearSuscripcionDuracionUnMes(Request $request, $fechaHoy, $fechaEnUnMes, $idUltimoUsuario)
    {
        Suscripcion::create([
            'fecha_inicio' => $fechaHoy,
            'fecha_expiracion' => $fechaEnUnMes,
            'numero_operacion_pago' => $request->numero_operacion_pago,
            'dias_suscripcion' => $this->diasRestantesSuscripcion($request->fecha_expiracion),
            'usuario_id' => $idUltimoUsuario,
            'estado_id' => 1,
            'metodo_pago_id' => $request->metodo_pago_id,
            'instrumento_id' => $request->instrumento_id
        ]);
    }

    // Función para crear una suscripción de un año
    public function crearSuscripcionDuracionUnAnio(Request $request, $fechaHoy, $fechaEnUnAnio, $idUltimoUsuario)
    {
        Suscripcion::create([
            'fecha_inicio' => $fechaHoy,
            'fecha_expiracion' => $fechaEnUnAnio,
            'numero_operacion_pago' => $request->numero_operacion_pago,
            'dias_suscripcion' => $this->diasRestantesSuscripcion($request->fecha_expiracion),
            'usuario_id' => $idUltimoUsuario,
            'estado_id' => 1,
            'metodo_pago_id' => $request->metodo_pago_id,
            'instrumento_id' => $request->instrumento_id
        ]);
    }

    //Método para consultar todas las suscripciones
    public function consultarSuscripciones()
    {
        $suscripciones = Suscripcion::join('usuarios', 'suscripciones.usuario_id', '=', 'usuarios.id')
            ->join('estados', 'suscripciones.estado_id', '=', 'estados.id')
            ->select('suscripciones.*', 'estados.nombre_estado as nombre_estado', 'usuarios.nombre_usuario as nombre_usuario', 'usuarios.apellido_usuario as apellido_usuario', 'usuarios.estado_id as usuario_estado_id', 'usuarios.email as correo_usuario')
            ->get();

        return $suscripciones;
    }

    //Método para consultar todas las suscripciones cuyos estados sean 'Activo', 'Por Vencer' o 'Pausado'
    public function consultarSuscripcionesVigentes()
    {
        $suscripciones = Suscripcion::join('usuarios', 'suscripciones.usuario_id', '=', 'usuarios.id')
            ->join('estados', 'suscripciones.estado_id', '=', 'estados.id')
            ->join('instrumentos', 'suscripciones.instrumento_id', '=', 'instrumentos.id')
            ->select('suscripciones.*', 'estados.nombre_estado as nombre_estado', 'usuarios.nombre_usuario as nombre_usuario', 'usuarios.apellido_usuario as apellido_usuario', 'usuarios.estado_id as usuario_estado_id', 'instrumentos.nombre_instrumento as nombre_instrumento')
            ->whereIn('suscripciones.estado_id', [1,3,5])
            ->get();

        return $suscripciones;
    }




    //Método para consultar los días restantes (Devuelve un INT)
    public function diasRestantesSuscripcion($fecha_expiracion)
    {
        $fecha1 = date_create(now());
        $fecha2 = date_create($fecha_expiracion);
        $dias = date_diff($fecha1, $fecha2)->days;
        if ($fecha1 > $fecha2) {
            $dias = -$dias;
        }
        return $dias;
    }

    //Función para calcular la fecha de expiracion a partir de los dias restantes de una suscripcion
    public function calcularFechaExpiracionPausadoActivo($diasRestantes)
    {
        $fechaHoy = Carbon::now();
        $fechaExpiracion = $fechaHoy->addDays($diasRestantes)->toDateString();
        return $fechaExpiracion;
    }

    //Método para actualizar los dias restantes de cada suscripción en el archivo de schedules
    public function actualizarDiasRestantesSuscripcion()
    {
        $suscripciones = $this->consultarSuscripciones();

        foreach ($suscripciones as $suscripcion) {
            //Introducimos los días restantes de la suscripción del usuario si su estado es 'activo' o 'por vencer'
            if ($suscripcion->estado_id == 1 || $suscripcion->estado_id == 3) {
                $suscripcion->where('id', '=', $suscripcion->id)
                    ->update([
                        'dias_suscripcion' => $this->diasRestantesSuscripcion($suscripcion->fecha_expiracion)
                    ]);
                //Si el estado del usuario es inactivo los días restantes de suscripción pasarán a ser 0
            } elseif ($suscripcion->estado_id == 6) {
                $suscripcion->where('id', '=', $suscripcion->id)
                    ->update([
                        'dias_suscripcion' => -6
                    ]);
            }
            //No hemos controlado el estado 'pausado' puesto que ese nos interesa que no actualice los días y se mantenga tal y como está
        }
    }

    public function controlarEstadoSuscripcion()
    {
        $suscripciones = $this->consultarSuscripciones();

        foreach ($suscripciones as $suscripcion) {
            if ($suscripcion->dias_suscripcion <= 5 && $suscripcion->dias_suscripcion >= -5) {
                $suscripcion->where('id', '=', $suscripcion->id)
                    ->update([
                        'estado_id' => 3
                    ]);
            } elseif ($suscripcion->dias_suscripcion < -5) {
                $suscripcion->where('id', '=', $suscripcion->id)
                    ->update([
                        'estado_id' => 6
                    ]);
            }
        }
    }


    // Actualizacion

    public function renovarSuscripcion(Request $request, Suscripcion $suscripcion)
    {
        $fechaHoy = Carbon::now()->toDateString();
        $fechaEnUnMes = Carbon::now()->addMonth()->toDateString();
        $fechaEnUnAnio = Carbon::now()->addYear()->toDateString();

        if ($request->renovarSuscripcion == 'si') {
            if ($request->duracion_suscripcion == 'personalizada') {
                $suscripcion->update([
                    'estado_id' => '6'
                ]);
                Suscripcion::create([
                    'fecha_inicio' => $fechaHoy,
                    'fecha_expiracion' => $request->fecha_expiracion,
                    'instrumento_id' => $request->instrumento_id,
                    'numero_operacion_pago' => $request->numero_operacion_pago,
                    'usuario_id' => $suscripcion->usuario_id,
                    'estado_id' => 1,
                    'metodo_pago_id' => $request->metodo_pago_id
                ]);
            } else {
                if ($request->duracion_suscripcion == 'mes') {
                    $suscripcion->update([
                        'estado_id' => '6'
                    ]);
                    Suscripcion::create([
                        'fecha_inicio' => $fechaHoy,
                        'fecha_expiracion' => $fechaEnUnMes,
                        'instrumento_id' => $request->instrumento_id,
                        'numero_operacion_pago' => $request->numero_operacion_pago,
                        'usuario_id' => $suscripcion->usuario_id,
                        'estado_id' => 1,
                        'metodo_pago_id' => $request->metodo_pago_id
                    ]);
                } elseif ($request->duracion_suscripcion == 'anio') {
                    $suscripcion->update([
                        'estado_id' => '6'
                    ]);
                    Suscripcion::create([
                        'fecha_inicio' => $fechaHoy,
                        'fecha_expiracion' => $fechaEnUnAnio,
                        'instrumento_id' => $request->instrumento_id,
                        'numero_operacion_pago' => $request->numero_operacion_pago,
                        'usuario_id' => $suscripcion->usuario_id,
                        'estado_id' => 1,
                        'metodo_pago_id' => $request->metodo_pago_id
                    ]);
                }
            }
        } else {
            if ($request->estado_id == 1) {
                Suscripcion::create([
                    'fecha_inicio' => $fechaHoy,
                    'fecha_expiracion' => $this->calcularFechaExpiracionPausadoActivo($suscripcion->dias_suscripcion),
                    'instrumento_id' => $request->instrumento_id,
                    'numero_operacion_pago' => $request->numero_operacion_pago,
                    'usuario_id' => $suscripcion->usuario_id,
                    'estado_id' => 1,
                    'metodo_pago_id' => $request->metodo_pago_id
                ]);
                $suscripcion->delete();
            } else {
                $suscripcion->update([
                    'estado_id' => $request->estado_id
                ]);
            }
        }

        //Actualizamos todos los días de todas las suscripciones al renovar por si acaso para asegurar que todo está en su sitio
        $this->actualizarDiasRestantesSuscripcion();
    }
}

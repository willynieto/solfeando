<?php

namespace App\Http\Controllers;

use App\Models\Estados\Persistencia\EstadosPersis;
use App\Models\MetodosPago\Persistencia\MetodosPagoPersis;
use App\Models\Suscripciones\Persistencia\SuscripcionesPersis;
use App\Models\Suscripciones\Suscripcion;
use App\Models\Suscripciones\Validaciones\SuscripcionesVal;
use App\Models\Usuarios\Persistencia\UsuariosPersis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    public function listar()
    {
        //Para mostrar las suscripciones
        $suscripcionPersis = new SuscripcionesPersis();
        $suscripciones = $suscripcionPersis->consultarSuscripcionesVigentes();

        return view('suscripcion.listado', compact('suscripciones'));
    }

    public function editar(Suscripcion $suscripcion)
    {
        //Para mostrar el nombre completo del usuario y su empresa
        $usuarioPersis = new UsuariosPersis();
        $usuarios = $usuarioPersis->consultarUsuarioDeSuscripcion($suscripcion);

        //Para mostrar los métodos de pago en el select
        $metodoPagoPersis = new MetodosPagoPersis();
        $metodosPago = $metodoPagoPersis->consultarMetodosPago();

        //Para mostrar los estados en el select
        $estadoPersis = new EstadosPersis();
        $estados = $estadoPersis->consultarEstados();

        return view('suscripcion.editar', compact('suscripcion', 'usuarios', 'metodosPago', 'estados'));
    }

    public function actualizar(Request $request, Suscripcion $suscripcion)
    {
        //Variable para validar los datos de la edición de datos de suscripcion
        $suscripcionVal = new SuscripcionesVal();

        //Variable para actualizar los datos de la suscripcion en la base de datos
        $suscripcionPersis = new SuscripcionesPersis();

        $suscripcionVal->validarEdicionSuscripcion($request);
        $suscripcionPersis->renovarSuscripcion($request, $suscripcion);

        return redirect(route('listado-suscripciones'))->with('exitoActualizado', 'La suscripción ha sido actualizada exitosamente');
    }
}

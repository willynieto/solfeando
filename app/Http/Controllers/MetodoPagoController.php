<?php

namespace App\Http\Controllers;

use App\Models\MetodosPago\MetodoPago;
use App\Models\MetodosPago\Persistencia\MetodosPagoPersis;
use App\Models\MetodosPago\Validaciones\MetodosPagoVal;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function listar()
    {
        //Para mostrar los métodos de pago
        $metodoPagoPersis = new MetodosPagoPersis();
        $metodosPago = $metodoPagoPersis->consultarMetodosPago();

        return view('metodo_pago.listado', compact('metodosPago'));
    }

    public function verRegistro()
    {
        return view('metodo_pago.registrar');
    }

    public function guardarDatos(Request $request)
    {
        $metodoPagoVal = new MetodosPagoVal();
        $metodoPagoPersis = new MetodosPagoPersis();

        $metodoPagoVal->validacionMetodosPago($request);

        $metodoPagoPersis->crearMetodoPago($request);

        return redirect(route('listado-metodos-pago'))->with('exitoCreado', 'Método de pago registrado con éxito');
    }

    public function editar(MetodoPago $metodoPago)
    {
        return view('metodo_pago.editar', compact('metodoPago'));
    }

    public function actualizar(Request $request, MetodoPago $metodoPago)
    {
        $metodoPagoVal = new MetodosPagoVal();
        $metodoPagoPersis = new MetodosPagoPersis();

        $metodoPagoVal->validacionMetodosPago($request);

        $metodoPagoPersis->actualizarMetodoPago($request, $metodoPago);

        return redirect(route('listado-metodos-pago'))->with('exitoActualizado', 'Método de pago actualizado con éxito');
    }

    public function eliminar(MetodoPago $metodoPago)
    {
        $metodoPagoPersis = new MetodosPagoPersis();
        $metodoPagoPersis->eliminarMetodoPago($metodoPago);

        return redirect(route('listado-metodos-pago'))->with('exitoBorrado', 'Método de pago eliminado con éxito');
    }
}

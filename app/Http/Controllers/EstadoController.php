<?php

namespace App\Http\Controllers;

use App\Models\Estados\Estado;
use App\Models\Estados\Persistencia\EstadosPersis;
use App\Models\Estados\Validaciones\EstadosVal;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function listar()
    {
        //Para mostrar los estados
        $estadoPersis = new EstadosPersis();
        $estados = $estadoPersis->consultarEstados();

        return view('estado.listado', compact('estados'));
    }

    public function verRegistro()
    {
        return view('estado.registrar');
    }

    public function guardarDatos(Request $request)
    {
        $estadoVal = new EstadosVal();
        $estadoPersis = new EstadosPersis();

        $estadoVal->validacionEstado($request);

        $estadoPersis->crearEstado($request);

        return redirect(route('listado-estados'))->with('exitoCreado', 'Estado registrado con éxito');
    }

    public function editar(Estado $estado)
    {
        return view('estado.editar', compact('estado'));
    }

    public function actualizar(Request $request, Estado $estado)
    {
        $estadoVal = new EstadosVal();
        $estadoPersis = new EstadosPersis();

        $estadoVal->validacionEstado($request);

        $estadoPersis->actualizarEstado($request, $estado);

        return redirect(route('listado-estados'))->with('exitoActualizado', 'Estado actualizado con éxito');
    }

    public function eliminar(Estado $estado)
    {
        $estadoPersis = new EstadosPersis();
        $estadoPersis->eliminarEstado($estado);

        return redirect(route('listado-estados'))->with('exitoBorrado', 'Estado eliminado con éxito');
    }
}

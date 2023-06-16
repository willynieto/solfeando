<?php

namespace App\Http\Controllers;

use App\Models\Paises\Persistencia\PaisesPersis;
use App\Models\Paises\Validaciones\PaisesVal;
use Illuminate\Http\Request;
use App\Models\Paises\Pais;

class PaisController extends Controller
{
    public function listar()
    {
        //Para mostrar los paises
        $paisPersis = new PaisesPersis();
        $paises = $paisPersis->consultarPaises();

        return view('pais.listado', compact('paises'));
    }

    public function verRegistro()
    {
        return view('pais.registrar');
    }

    public function guardarDatos(Request $request)
    {
        $paisVal = new PaisesVal();
        $paisPersis = new PaisesPersis();

        $paisVal->validacionPais($request);

        $paisPersis->crearPais($request);

        return redirect(route('listado-paises'))->with('exitoCreado', 'País registrado con éxito');
    }

    public function editar(Pais $pais)
    {
        return view('pais.editar', compact('pais'));
    }

    public function actualizar(Request $request, Pais $pais)
    {
        $paisVal = new PaisesVal();
        $paisPersis = new PaisesPersis();

        $paisVal->validacionPais($request);

        $paisPersis->actualizarPais($request, $pais);

        return redirect(route('listado-paises'))->with('exitoActualizado', 'País actualizado con éxito');
    }

    public function eliminar(Pais $pais)
    {
        $paisPersis = new PaisesPersis();
        $paisPersis->eliminarPais($pais);

        return redirect(route('listado-paises'))->with('exitoBorrado', 'País eliminado con éxito');
    }
}

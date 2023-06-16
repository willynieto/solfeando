<?php

namespace App\Http\Controllers;

use App\Models\Ciudades\Ciudad;
use Illuminate\Http\Request;
use App\Models\Ciudades\Persistencia\CiudadesPersis;
use App\Models\Ciudades\Validaciones\CiudadesVal;
use App\Models\Paises\Persistencia\PaisesPersis;

class CiudadController extends Controller
{
    //Método para consultar las ciudades filtrandolas por país
    public function porPais(Request $request)
    {
        $ciudadPersis = new CiudadesPersis();
        $ciudades = $ciudadPersis->consultarCiudadesPorPais($request);
        return response()->json([
            $ciudades
        ]);
    }

    public function listar()
    {
        //Para mostrar las ciudades
        $ciudadPersis = new CiudadesPersis();
        $ciudades = $ciudadPersis->consultarCiudadesParaListar();

        return view('ciudad.listado', compact('ciudades'));
    }

    public function verRegistro(Request $request)
    {
        //Para mostrar los paises en el select
        $paisPersis = new PaisesPersis();
        $paises = $paisPersis->consultarPaises();

        return view('ciudad.registrar', compact('paises'));
    }

    public function guardarDatos(Request $request)
    {
        $ciudadVal = new CiudadesVal();
        $ciudadPersis = new CiudadesPersis();

        $ciudadVal->validacionCiudad($request);

        $ciudadPersis->crearCiudad($request);

        return redirect(route('listado-ciudades'))->with('exitoCreado', 'Ciudad registrada con éxito');
    }

    public function editar(Ciudad $ciudad)
    {
        //Para mostrar los paises en el select
        $paisPersis = new PaisesPersis();
        $paises = $paisPersis->consultarPaises();

        return view('ciudad.editar', compact('ciudad', 'paises'));
    }

    public function actualizar(Request $request, Ciudad $ciudad)
    {
        $ciudadVal = new CiudadesVal();
        $ciudadPersis = new CiudadesPersis();

        $ciudadVal->validacionCiudad($request);

        $ciudadPersis->actualizarCiudad($request, $ciudad);

        return redirect(route('listado-ciudades'))->with('exitoActualizado', 'Ciudad actualizada con éxito');
    }

    public function eliminar(Ciudad $ciudad)
    {
        $ciudadPersis = new CiudadesPersis();
        $ciudadPersis->eliminarCiudad($ciudad);

        return redirect(route('listado-ciudades'))->with('exitoBorrado', 'Ciudad eliminada con éxito');
    }

}

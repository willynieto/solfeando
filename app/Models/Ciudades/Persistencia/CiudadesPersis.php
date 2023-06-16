<?php

namespace App\Models\Ciudades\Persistencia;

use App\Models\Ciudades\Ciudad;
use App\Models\Usuarios\Usuario;
use Illuminate\Http\Request;

class CiudadesPersis {

    //Método para consultar las ciudades de un país en específico
    public function consultarCiudadesPorPais(Request $request)
    {
        return Ciudad::where('pais_id', $request->paisID)->get();
    }

    //Método para consultar las ciudades de un usuario en específico
    public function consultarCiudadesDeUsuario(Usuario $usuario)
    {
        return Ciudad::where('pais_id', $usuario->pais_id)->get();
    }

    //Método para consultar las ciudades y el nombre del pais al que están asociadas cada una
    public function consultarCiudadesParaListar()
    {
        $ciudades = Ciudad::join('paises', 'ciudades.pais_id', '=', 'paises.id')
            ->select('ciudades.*', 'paises.nombre_pais as nombre_pais')
            ->get();

        return $ciudades;
    }

    //Método para crear paises
    public function crearCiudad(Request $request)
    {
        Ciudad::create([
            'nombre_ciudad' => $request->nombre_ciudad,
            'pais_id' => $request->pais_id
        ]);
    }

    //Método para actualizar paises
    public function actualizarCiudad(Request $request, Ciudad $ciudad)
    {
        $ciudad->update([
            'nombre_ciudad' => $request->nombre_ciudad,
            'pais_id' => $request->pais_id
        ]);
    }

    //Método para borrar paises
    public function eliminarCiudad(Ciudad $ciudad)
    {
        $ciudad->delete();
    }
}

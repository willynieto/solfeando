<?php

namespace App\Models\Paises\Persistencia;

use App\Models\Paises\Pais;
use Illuminate\Http\Request;

class PaisesPersis
{
    //Metodo para consultar únicamente paises que tengan alguna ciudad asociada
    public function consultarPaisesConCiudades()
    {
        $paises = Pais::select('paises.*')
            ->join('ciudades as ciudad', 'paises.id', '=', 'ciudad.pais_id')
            ->groupBy('paises.id')
            ->orderBy('nombre_pais')
            ->get();
        return $paises;
    }

    //Método para consultar todos los paises
    public function consultarPaises()
    {
        return Pais::all();
    }

    //Método para crear paises
    public function crearPais(Request $request)
    {
        Pais::create([
            'nombre_pais' => $request->nombre_pais
        ]);
    }

    //Método para actualizar paises
    public function actualizarPais(Request $request, Pais $pais)
    {
        $pais->update([
            'nombre_pais' => $request->nombre_pais
        ]);
    }

    //Método para borrar paises
    public function eliminarPais(Pais $pais)
    {
        $pais->delete();
    }

}

<?php

namespace App\Models\Ciudades\Validaciones;

use Illuminate\Http\Request;

class CiudadesVal {

    public function validacionCiudad(Request $request)
    {
        $request->validate([
            'nombre_ciudad' => 'required|string|max:45',
            'pais_id' => 'required'
        ]);
    }

}

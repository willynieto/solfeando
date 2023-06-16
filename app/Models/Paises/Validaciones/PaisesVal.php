<?php

namespace App\Models\Paises\Validaciones;

use Illuminate\Http\Request;

class PaisesVal {

    public function validacionPais(Request $request)
    {
        $request->validate([
            'nombre_pais' => 'required|string|max:45',
        ]);
    }

}

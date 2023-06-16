<?php

namespace App\Models\Foros\Validaciones;

use Illuminate\Http\Request;

class ForosVal {

    public function validacionCiudad(Request $request)
    {
        $request->validate([
            'asunto' => 'required|max:45',
            'contenido' => 'required|max:300'
        ]);
    }

}

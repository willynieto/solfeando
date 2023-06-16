<?php

namespace App\Models\Estados\Validaciones;

use Illuminate\Http\Request;

class EstadosVal {

    public function validacionEstado(Request $request)
    {
        $request->validate([
            'nombre_estado' => 'required|string|max:15',
        ]);
    }

}

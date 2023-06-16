<?php

namespace App\Models\Roles\Validaciones;

use Illuminate\Http\Request;

class RolesVal {

    public function validacionRol(Request $request)
    {
        $request->validate([
            'nombre_rol' => 'required|string|max:25',
        ]);
    }

}

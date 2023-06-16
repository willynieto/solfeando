<?php

namespace App\Models\Roles\Persistencia;

use App\Models\Roles\Rol;
use Illuminate\Http\Request;

class RolesPersis
{
    //Método para consultar roles
    public function consultarRoles()
    {
        return Rol::all();
    }

    //Método para crear roles
    public function crearRol(Request $request)
    {
        Rol::create([
            'nombre_rol' => $request->nombre_rol
        ]);
    }

    //Método para actualizar roles
    public function actualizarRol(Request $request, Rol $rol)
    {
        $rol->update([
            'nombre_rol' => $request->nombre_rol
        ]);
    }

    //Método para borrar roles
    public function eliminarRol(Rol $rol)
    {
        $rol->delete();
    }
}

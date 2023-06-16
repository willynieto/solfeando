<?php

namespace App\Http\Controllers;

use App\Models\Roles\Persistencia\RolesPersis;
use App\Models\Roles\Validaciones\RolesVal;
use Illuminate\Http\Request;
use App\Models\Roles\Rol;

class RolController extends Controller
{

    public function listar()
    {
        //Para mostrar los roles
        $rolPersis = new RolesPersis();
        $roles = $rolPersis->consultarRoles();

        return view('rol.listado', compact('roles'));
    }

    public function verRegistro()
    {
        return view('rol.registrar');
    }

    public function guardarDatos(Request $request)
    {
        $rolVal = new RolesVal();
        $rolPersis = new RolesPersis();

        $rolVal->validacionRol($request);

        $rolPersis->crearRol($request);

        return redirect(route('listado-roles'))->with('exitoCreado', 'Rol registrado con éxito');
    }

    public function editar(Rol $rol)
    {
        return view('rol.editar', compact('rol'));
    }

    public function actualizar(Request $request, Rol $rol)
    {
        $rolVal = new RolesVal();
        $rolPersis = new RolesPersis();

        $rolVal->validacionRol($request);

        $rolPersis->actualizarRol($request, $rol);

        return redirect(route('listado-roles'))->with('exitoActualizado', 'Rol actualizado con éxito');
    }

    public function eliminar(Rol $rol)
    {
        $rolPersis = new RolesPersis();
        $rolPersis->eliminarRol($rol);

        return redirect(route('listado-roles'))->with('exitoBorrado', 'Rol eliminado con éxito');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instrumentos\Persistencia\InstrumentosPersis;
use App\Models\Usuarios\Persistencia\UsuariosPersis;

class InicioController extends Controller
{
    public function verInicio()
    {
        $usuarioPersis = new UsuariosPersis();
        $cantidadAlumnos = $usuarioPersis->contarUsuariosAlumnos();
        $cantidadProfesores = $usuarioPersis->contarUsuariosProfesores();

        //Para mostrar los instrumentos en el select
        $instrumentoPersis = new InstrumentosPersis();
        $cantidadInstrumentos = $instrumentoPersis->contarInstrumentos();

        return view('dashboard.inicio', compact('cantidadAlumnos', 'cantidadProfesores', 'cantidadInstrumentos'));
    }
}

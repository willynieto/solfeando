<?php

namespace App\Models\Estados\Persistencia;

use App\Models\Estados\Estado;
use Illuminate\Http\Request;

class EstadosPersis
{
    //Método para consultar todos los estados
    public function consultarEstados()
    {
        $estados = Estado::all();
        return $estados;
    }

    //Método para crear estados
    public function crearEstado(Request $request)
    {
        Estado::create([
            'nombre_estado' => $request->nombre_estado
        ]);
    }

    //Método para actualizar estados
    public function actualizarEstado(Request $request, Estado $estado)
    {
        $estado->update([
            'nombre_estado' => $request->nombre_estado
        ]);
    }

    //Método para borrar estados
    public function eliminarEstado(Estado $estado)
    {
        $estado->delete();
    }
}

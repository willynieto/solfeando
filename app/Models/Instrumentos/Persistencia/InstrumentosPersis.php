<?php

namespace App\Models\Instrumentos\Persistencia;

use App\Models\Instrumentos\Instrumento;
use Illuminate\Http\Request;

class InstrumentosPersis
{
    //Método para consultar instrumentos
    public function consultarInstrumentos()
    {
        return Instrumento::all();
    }

    //Metodo para contar instrumentos y mostrarlos en el inicio
    public function contarInstrumentos()
    {
        return Instrumento::count();
    }

    //Método para crear instrumentos
    public function crearInstrumento(Request $request)
    {
        Instrumento::create([
            'nombre_rol' => $request->nombre_rol
        ]);
    }

    //Método para actualizar instrumentos
    public function actualizarInstrumento(Request $request, Instrumento $instrumento)
    {
        $instrumento->update([
            'nombre_instrumento' => $request->nombre_instrumento
        ]);
    }

    //Método para borrar instrumentos
    public function eliminarInstrumento(Instrumento $instrumento)
    {
        $instrumento->delete();
    }
}

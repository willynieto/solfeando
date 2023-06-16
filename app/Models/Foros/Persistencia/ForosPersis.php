<?php

namespace App\Models\Foros\Persistencia;

use App\Models\Foros\Foro;
use App\Models\Usuarios\Usuario;
use Illuminate\Http\Request;

class ForosPersis {

    //Método para consultar todos los registro de la tabla foros
    public function consultarForos()
    {
        $foros = Foro::join('usuarios', 'foros.usuario_id', '=', 'usuarios.id')
            ->join('suscripciones', 'usuarios.id', '=', 'suscripciones.usuario_id')
            ->join('instrumentos', 'suscripciones.intrumento_id', '=', 'instrumentos.id')
            ->select('foros.*', 'usuarios.nombre_usuario as nombre_usuario', 'intrumentos.nombre_instrumento as nombre_instrumento')
            ->get();

        return $foros;
    }

    //Método para crear paises
    public function crearForo(Request $request, Usuario $usuario)
    {
        Foro::create([
            'asunto' => $request->asunto,
            'contenido' => $request->contenido,
            'usuario_id' => $usuario->id
        ]);
    }

    //Método para borrar paises
    public function eliminarForo(Foro $foro)
    {
        $foro->delete();
    }
}

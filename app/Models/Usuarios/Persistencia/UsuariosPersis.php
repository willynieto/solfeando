<?php

namespace App\Models\Usuarios\Persistencia;

use App\Models\Suscripciones\Suscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios\Usuario;


class UsuariosPersis
{
    //Método para consultar usuarios de la base de datos junto con datos compartidos de otras tablas
    public function consultarUsuarios()
    {
        $usuarios = Usuario::join('roles', 'usuarios.rol_id', '=', 'roles.id')
            ->join('paises', 'usuarios.pais_id', '=', 'paises.id')
            ->join('ciudades', 'usuarios.ciudad_id', '=', 'ciudades.id')
            ->join('estados', 'usuarios.estado_id', '=', 'estados.id')
            ->select('usuarios.*', 'estados.nombre_estado as nombre_estado', 'roles.nombre_rol as nombre_rol', 'paises.nombre_pais as nombre_pais', 'ciudades.nombre_ciudad as nombre_ciudad')
            ->get();

        return $usuarios;
    }

    //Método para contar usuarios con el Rol de alumno
    public function contarUsuariosAlumnos()
    {
        return Usuario::where('rol_id', 2)->count();
    }

    //Método para contar usuarios con el Rol de profesor
    public function contarUsuariosProfesores()
    {
        return Usuario::where('rol_id', 3)->count();
    }

    //Consulta los usuarios junto con sus respectivas suscripciones
    public function consultarUsuariosConSuSuscripcion()
    {
        $usuarios = Usuario::join('suscripciones', 'usuarios.id', '=', 'suscripciones.usuario_id')
            ->select('usuarios.*', 'suscripciones.estado_id as suscripcion_estado_id', 'suscripciones.dias_suscripcion as dias_suscripcion')
            ->get();

        return $usuarios;
    }

    public function crearUsuario(Request $request) {
        Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'apellido_usuario' => $request->apellido_usuario,
            'postal_usuario' => $request->postal_usuario,
            'direccion_usuario' => $request->direccion_usuario,
            'telefono_usuario' => $request->telefono_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pais_id' => $request->pais_id,
            'ciudad_id' => $request->ciudad_id,
            'rol_id' => $request->rol_id,
            'estado_id' => 1
        ]);
    }

    public function crearUsuarioSuperAdmin(Request $request) {
        Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'apellido_usuario' => $request->apellido_usuario,
            'postal_usuario' => $request->postal_usuario,
            'direccion_usuario' => $request->direccion_usuario,
            'telefono_usuario' => $request->telefono_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pais_id' => $request->pais_id,
            'ciudad_id' => $request->ciudad_id,
            'rol_id' => $request->rol_id,
            'estado_id' => 1
        ]);
    }

    public function consultarIdUltimoUsuarioCreado() {
        $idUsuario = Usuario::latest()->first();
        return $idUsuario;
    }

    //Método para consultar el usuario de una suscripción en específico
    public function consultarUsuarioDeSuscripcion(Suscripcion $suscripcion)
    {
        return Usuario::where('id', $suscripcion->usuario_id)->first();
    }

    public function actualizarUsuarioSinPassword(Request $request, Usuario $usuario)
    {
        $usuario->update([
            'nombre_usuario' => $request->nombre_usuario,
            'apellido_usuario' => $request->apellido_usuario,
            'postal_usuario' => $request->postal_usuario,
            'direccion_usuario' => $request->direccion_usuario,
            'telefono_usuario' => $request->telefono_usuario,
            'email' => $request->email,
            'pais_id' => $request->pais_id,
            'ciudad_id' => $request->ciudad_id,
            'rol_id' => $request->rol_id,
            'estado_id' => $request->estado_id
        ]);
    }

    public function actualizarUsuarioConPassword(Request $request, Usuario $usuario)
    {
        $usuario->update([
            'nombre_usuario' => $request->nombre_usuario,
            'apellido_usuario' => $request->apellido_usuario,
            'postal_usuario' => $request->postal_usuario,
            'direccion_usuario' => $request->direccion_usuario,
            'telefono_usuario' => $request->telefono_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pais_id' => $request->pais_id,
            'ciudad_id' => $request->ciudad_id,
            'rol_id' => $request->rol_id,
            'estado_id' => $request->estado_id
        ]);
    }

    //Método para borrar usuarios
    public function eliminarUsuario(Usuario $usuario)
    {
        $usuario->delete();
    }

    public function controlarEstadoUsuario() {
        $usuarios = $this->consultarUsuariosConSuSuscripcion();

        foreach($usuarios as $usuario) {
            if($usuario->dias_suscripcion <= 5) {
                $usuario->where('id', '=', $usuario->id)
                ->update([
                    'estado_id' => 3
                ]);
            } elseif ($usuario->dias_suscripcion < -5) {
                $usuario->where('id', '=', $usuario->id)
                ->update([
                    'estado_id' => 2
                ]);
            }

            if ($usuario->suscripcion_estado_id == 1) {
                $usuario->where('id', '=', $usuario->id)
                ->update([
                    'estado_id' => 1
                ]);
            } elseif ($usuario->suscripcion_estado_id == 3) {
                $usuario->where('id', '=', $usuario->id)
                ->update([
                    'estado_id' => 1
                ]);
            } elseif ($usuario->suscripcion_estado_id == 5) {
                $usuario->where('id', '=', $usuario->id)
                ->update([
                    'estado_id' => 5
                ]);
            } elseif ($usuario->suscripcion_estado_id == 6) {
                $usuario->where('id', '=', $usuario->id)
                ->update([
                    'estado_id' => 2
                ]);
            }
        }
    }
}

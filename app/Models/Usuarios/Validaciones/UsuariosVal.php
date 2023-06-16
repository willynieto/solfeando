<?php

namespace App\Models\Usuarios\Validaciones;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UsuariosVal
{

    public function validacionLoginUsuario(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:250',
            'password' => 'required'
        ]);
    }

    public function validacionEdicionUsuarioConContrasenia(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:25',
            'apellido_usuario' => 'required|string|max:25',
            'postal_usuario' => 'required|numeric|digits_between:1,15',
            'direccion_usuario' => 'required',
            'telefono_usuario' => 'required|numeric|digits_between:1,15',
            'email' => 'required|email|max:250',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'passwordConfirm' => 'required|same:password',
            'pais_id' => 'required',
            'ciudad_id' => 'required',
            'rol_id' => 'required',
            'estado_id' => 'required'
        ]);
    }

    public function validacionEdicionUsuarioSinContrasenia(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:25',
            'apellido_usuario' => 'required|string|max:25',
            'postal_usuario' => 'required|numeric|digits_between:1,15',
            'direccion_usuario' => 'required',
            'telefono_usuario' => 'required|numeric|digits_between:1,15',
            'email' => 'required|email|max:250',
            'pais_id' => 'required',
            'ciudad_id' => 'required',
            'rol_id' => 'required',
            'estado_id' => 'required'
        ]);
    }

    public function validacionUsuarioBasica(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:25',
            'apellido_usuario' => 'required|string|max:25',
            'postal_usuario' => 'required|numeric|digits_between:1,15',
            'direccion_usuario' => 'required',
            'telefono_usuario' => 'required|numeric|digits_between:1,15',
            'email' => 'required|email|max:250',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'pais_id' => 'required',
            'ciudad_id' => 'required',
            'rol_id' => 'required',

            'instrumento_id' => 'required',

            'duracion_suscripcion' => 'required',

            'numero_operacion_pago' => 'required',
            'metodo_pago_id' => 'required'
        ]);
    }

    public function validacionUsuarioSuperAdmin(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:25',
            'apellido_usuario' => 'required|string|max:25',
            'postal_usuario' => 'required|numeric|digits_between:1,15',
            'direccion_usuario' => 'required',
            'telefono_usuario' => 'required|numeric|digits_between:1,15',
            'email' => 'required|email|max:250',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'pais_id' => 'required',
            'ciudad_id' => 'required',
            'rol_id' => 'required'
        ]);
    }

    public function validacionUsuarioConDuracionPersonalizada(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:25',
            'apellido_usuario' => 'required|string|max:25',
            'postal_usuario' => 'required|numeric|digits_between:1,15',
            'direccion_usuario' => 'required',
            'telefono_usuario' => 'required|numeric|digits_between:1,15',
            'email' => 'required|email|max:250',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'pais_id' => 'required',
            'ciudad_id' => 'required',
            'rol_id' => 'required',

            'instrumento_id' => 'required',

            'duracion_suscripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_expiracion' => 'required|date',

            'numero_operacion_pago' => 'required',
            'metodo_pago_id' => 'required'
        ]);
    }
}

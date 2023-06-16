<?php

namespace App\Http\Controllers;

use App\Models\Usuarios\Validaciones\UsuariosVal;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request) {

        $usuarioVal = new UsuariosVal();

        $usuarioVal->validacionLoginUsuario($request);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $remember = $request->filled('remember');

        if(Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect('inicio');
        } else {
            return back()->withErrors([
                'email' => 'Las credenciales no concuerdan con nuestros registros.',
            ])->onlyInput('email');
        }

    }

    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ciudades\Persistencia\CiudadesPersis;
use App\Models\Estados\Persistencia\EstadosPersis;
use App\Models\MetodosPago\Persistencia\MetodosPagoPersis;
use App\Models\Paises\Persistencia\PaisesPersis;
use App\Models\Roles\Persistencia\RolesPersis;
use App\Models\Instrumentos\Persistencia\InstrumentosPersis;
use App\Models\Usuarios\Persistencia\UsuariosPersis;
use App\Models\Suscripciones\Persistencia\SuscripcionesPersis;
use App\Models\Usuarios\Usuario;
use App\Models\Usuarios\Validaciones\UsuariosVal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    public function verRegistro(Request $request)
    {
        //Para mostrar los paises en el select
        $paisPersis = new PaisesPersis();
        $paises = $paisPersis->consultarPaisesConCiudades();

        //Para mostrar los roles en el select
        $rolPersis = new RolesPersis();
        $roles = $rolPersis->consultarRoles();

        //Para mostrar los métodos de pago en el select
        $metodoPagoPersis = new MetodosPagoPersis();
        $metodosPago = $metodoPagoPersis->consultarMetodosPago();

        //Para mostrar los instrumentos en el select
        $instrumentoPersis = new InstrumentosPersis();
        $instrumentos = $instrumentoPersis->consultarInstrumentos();

        return view('usuario.registrar', compact('paises', 'roles', 'metodosPago', 'instrumentos'));
    }

    public function guardarDatos(Request $request)
    {

        //Variable de sesión para mostrar la ciudad seleccionada después de validar
        Session::flash('valorCiudad', $request->ciudad_id);

        //Variable para validar el registro de usuarios
        $usuarioVal = new UsuariosVal();

        //Variable para llamar a los método sobre la persistencia de la clase usuarios
        $usuarioPersis = new UsuariosPersis();

        //Validación para la creación del usuario
        if ($request->rol_id !== '1') {
            //Variable de sesión para mantener visible los campos sobre la suscripción después de validar
            Session::flash('validacionDatosSuscripcion', true);

            if ($request->duracion_suscripcion == 'personalizada') {

                //Variables de sesión para mantener visibles los campos 'fecha_inicio' y 'fecha_expiracion' después de validar
                Session::flash('validacionFechas', true);
                $usuarioVal->validacionUsuarioConDuracionPersonalizada($request);

            } else {

                $usuarioVal->validacionUsuarioBasica($request);

            }

            $usuarioPersis->crearUsuario($request);

            $ultimoUsuario = $usuarioPersis->consultarIdUltimoUsuarioCreado();
            $idUltimoUsuario = $ultimoUsuario->id;

            $fechaHoy = Carbon::now()->toDateString();
            $fechaEnUnMes = Carbon::now()->addMonth()->toDateString();
            $fechaEnUnAnio = Carbon::now()->addYear()->toDateString();

            //Variable para crear los registros en la tabla Suscripciones
            $suscripcionPersis = new SuscripcionesPersis();

            //Cadena de if para introducir los datos que se piden en la base de datos
            if ($request->duracion_suscripcion == 'personalizada') {
                $suscripcionPersis->crearSuscripcionDuracionPersonalizada($request, $idUltimoUsuario);

            } elseif ($request->duracion_suscripcion == 'mes') {
                $suscripcionPersis->crearSuscripcionDuracionUnMes($request, $fechaHoy, $fechaEnUnMes, $idUltimoUsuario);

            } elseif ($request->duracion_suscripcion == 'anio') {
                $suscripcionPersis->crearSuscripcionDuracionUnAnio($request, $fechaHoy, $fechaEnUnAnio, $idUltimoUsuario);

            }

        } else {


            $usuarioVal->validacionUsuarioSuperAdmin($request);


            $usuarioPersis->crearUsuarioSuperAdmin($request);

        }

        $suscripcionPersis->actualizarDiasRestantesSuscripcion();

        // Una vez se haga el registro de usuario, retornamos al usuario la vista de registro,...
        // ...pero en este caso vacía y con un mensaje de exito a través de la función with para devolver feedback
        // 'exito' es la bandera que luego en nuestra vista vamos a recoger para saber si el registro ha sido exitoso o no
        return redirect(route('listado-usuarios'))->with('exitoCreado', 'Usuario registrado con éxito');
    }

    public function listar()
    {
        //Para mostrar los usuarios
        $usuarioPersis = new UsuariosPersis();
        $usuarios = $usuarioPersis->consultarUsuarios();

        return view('usuario.listado', compact('usuarios'));
    }

    public function editar(Usuario $usuario)
    {
        //Para mostrar los paises en el select
        $paisPersis = new PaisesPersis();
        $paises = $paisPersis->consultarPaisesConCiudades();

        //Para mostrar los roles en el select
        $rolPersis = new RolesPersis();
        $roles = $rolPersis->consultarRoles();

        //Para mostrar las ciudades en el select
        $ciudadPersis = new CiudadesPersis();
        $ciudades = $ciudadPersis->consultarCiudadesDeUsuario($usuario);

        //Para mostrar los estados en el select
        $estadoPersis = new EstadosPersis();
        $estados = $estadoPersis->consultarEstados();

        return view('usuario.editar', compact('usuario', 'paises', 'roles', 'ciudades', 'estados'));
    }

    public function actualizar(Request $request, Usuario $usuario)
    {
        //Variable para validar los datos de la edición de datos de usuario
        $usuarioVal = new UsuariosVal();

        //Variable para actualizar los datos del usuario en la base de datos
        $usuarioPersis = new UsuariosPersis();

        if ($request->cambiarPassword == 'si') {
            $usuarioVal->validacionEdicionUsuarioConContrasenia($request);
            $usuarioPersis->actualizarUsuarioConPassword($request, $usuario);
        } else {
            $usuarioVal->validacionEdicionUsuarioSinContrasenia($request);
            $usuarioPersis->actualizarUsuarioSinPassword($request, $usuario);
        }

        return redirect(route('listado-usuarios'))->with('exitoActualizado', 'El perfil del usuario ' . $usuario->nombre_usuario . ' ' . $usuario->apellido_usuario . ' ha sido actualizado exitosamente');
    }

    public function eliminar(Usuario $usuario)
    {
        $usuarioPersis = new UsuariosPersis();
        $usuarioPersis->eliminarUsuario($usuario);

        return redirect(route('listado-usuarios'))->with('exitoBorrado', 'El perfil del usuario ' . $usuario->nombre_usuario . ' ' . $usuario->apellido_usuario . ' ha sido eliminado');
    }
}

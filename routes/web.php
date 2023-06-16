<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\InicioController;


// |-------------------> RUTA INICIO <--------------------|
Route::get('/inicio', [InicioController::class, 'verInicio'])->middleware('auth')->name('inicio');




// |----------------> RUTAS LOGIN/LOGOUT <----------------|
//Ruta para mostrar la vista de login
Route::view('/login', "usuario.login")->name('login');
//Ruta para enviar los datos introducidos en el login al servidor y poder efectuar el inicio de sesión
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
//Ruta a la que se accede para cerrar sesión
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



// |---------> RUTAS RESTABLECIMIENTO PASSWORD <----------|
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');





// |----------------> RUTAS CRUD USUARIO <----------------|

// |---- REGISTRO ----|
//Ruta para la página de registro de usuarios:
Route::get('/registro-usuario', [UsuarioController::class, 'verRegistro'])->middleware('auth')->name('registro-usuario');
//Ruta para inserción de datos de usuario metidos en la ruta anterior:
Route::post('/guardar-datos-usuario', [UsuarioController::class, 'guardarDatos'])->name('guardar-datos-usuario');

// |----- MOSTRAR ----|
//Ruta para listar las filas de la tabla usuarios
Route::get('/listado-usuarios', [UsuarioController::class, 'listar'])->middleware('auth')->name('listado-usuarios');
// |---- MOSTRAR CIUDADES EN SELECT ----|
//Ruta para devolver nombre de pais a través de el id
Route::get('/pais/{id}/ciudades', [CiudadController::class, 'porPais'])->name('ciudades');

// |---- EDICIÓN -----|
//Ruta para la vista de edición de un registro la tabla usuarios
Route::get('/editar-usuario/{usuario}', [UsuarioController::class, 'editar'])->middleware('auth')->name('editar-usuario');
//Ruta para actualizar el registro editado en la vista previa
Route::put('/actualizar-usuario/{usuario}', [UsuarioController::class, 'actualizar'])->name('actualizar-usuario');

// |---- BORRADO -----|
//Ruta para eliminar registros de la tabla usuarios
Route::delete('/eliminar-usuario/{usuario}', [UsuarioController::class, 'eliminar'])->name('eliminar-usuario');





// |----------------> RUTAS CRUD ROLES <----------------|

// |---- REGISTRO ----|
//Ruta para la página de registro de roles:
Route::get('/registro-rol', [RolController::class, 'verRegistro'])->middleware('auth')->name('registro-rol');
//Ruta para inserción de datos de roles metidos en la ruta anterior:
Route::post('/guardar-datos-rol', [RolController::class, 'guardarDatos'])->name('guardar-datos-rol');

// |----- MOSTRAR ----|
//Ruta para listar las filas de la tabla roles
Route::get('/listado-roles', [RolController::class, 'listar'])->middleware('auth')->name('listado-roles');

// |---- EDICIÓN -----|
//Ruta para la vista de edición de un registro la tabla roles
Route::get('/editar-rol/{rol}', [RolController::class, 'editar'])->middleware('auth')->name('editar-rol');
//Ruta para actualizar el registro editado en la vista previa
Route::put('/actualizar-rol/{rol}', [RolController::class, 'actualizar'])->name('actualizar-rol');

// |---- BORRADO -----|
//Ruta para eliminar registros de la tabla roles
Route::delete('/eliminar-rol/{rol}', [RolController::class, 'eliminar'])->name('eliminar-rol');




// |----------------> RUTAS CRUD PAISES <----------------|

// |---- REGISTRO ----|
//Ruta para la página de registro de paises:
Route::get('/registro-pais', [PaisController::class, 'verRegistro'])->middleware('auth')->name('registro-pais');
//Ruta para inserción de datos de paises metidos en la ruta anterior:
Route::post('/guardar-datos-pais', [PaisController::class, 'guardarDatos'])->name('guardar-datos-pais');

// |----- MOSTRAR ----|
//Ruta para listar las filas de la tabla paises
Route::get('/listado-paises', [PaisController::class, 'listar'])->middleware('auth')->name('listado-paises');

// |---- EDICIÓN -----|
//Ruta para la vista de edición de un registro la tabla paises
Route::get('/editar-pais/{pais}', [PaisController::class, 'editar'])->middleware('auth')->name('editar-pais');
//Ruta para actualizar el registro editado en la vista previa
Route::put('/actualizar-pais/{pais}', [PaisController::class, 'actualizar'])->name('actualizar-pais');

// |---- BORRADO -----|
//Ruta para eliminar registros de la tabla paises
Route::delete('/eliminar-pais/{pais}', [PaisController::class, 'eliminar'])->name('eliminar-pais');




// |----------------> RUTAS CRUD CIUDADES <----------------|

// |---- REGISTRO ----|
//Ruta para la página de registro de ciudades:
Route::get('/registro-ciudad', [CiudadController::class, 'verRegistro'])->middleware('auth')->name('registro-ciudad');
//Ruta para inserción de datos de ciudades metidos en la ruta anterior:
Route::post('/guardar-datos-ciudad', [CiudadController::class, 'guardarDatos'])->name('guardar-datos-ciudad');

// |----- MOSTRAR ----|
//Ruta para listar las filas de la tabla ciudades
Route::get('/listado-ciudades', [CiudadController::class, 'listar'])->middleware('auth')->name('listado-ciudades');

// |---- EDICIÓN -----|
//Ruta para la vista de edición de un registro la tabla ciudades
Route::get('/editar-ciudad/{ciudad}', [CiudadController::class, 'editar'])->middleware('auth')->name('editar-ciudad');
//Ruta para actualizar el registro editado en la vista previa
Route::put('/actualizar-ciudad/{ciudad}', [CiudadController::class, 'actualizar'])->name('actualizar-ciudad');

// |---- BORRADO -----|
//Ruta para eliminar registros de la tabla ciudades
Route::delete('/eliminar-ciudad/{ciudad}', [CiudadController::class, 'eliminar'])->name('eliminar-ciudad');





// |----------------> RUTAS CRUD ESTADOS <----------------|

// |---- REGISTRO ----|
//Ruta para la página de registro de estados:
Route::get('/registro-estado', [EstadoController::class, 'verRegistro'])->middleware('auth')->name('registro-estado');
//Ruta para inserción de datos de estados metidos en la ruta anterior:
Route::post('/guardar-datos-estado', [EstadoController::class, 'guardarDatos'])->name('guardar-datos-estado');

// |----- MOSTRAR ----|
//Ruta para listar las filas de la tabla estados
Route::get('/listado-estados', [EstadoController::class, 'listar'])->middleware('auth')->name('listado-estados');

// |---- EDICIÓN -----|
//Ruta para la vista de edición de un registro la tabla estados
Route::get('/editar-estado/{estado}', [EstadoController::class, 'editar'])->middleware('auth')->name('editar-estado');
//Ruta para actualizar el registro editado en la vista previa
Route::put('/actualizar-estado/{estado}', [EstadoController::class, 'actualizar'])->name('actualizar-estado');

// |---- BORRADO -----|
//Ruta para eliminar registros de la tabla estados
Route::delete('/eliminar-estado/{estado}', [EstadoController::class, 'eliminar'])->name('eliminar-estado');







// |----------------> RUTAS CRUD MÉTODOS DE PAGO <----------------|

// |---- REGISTRO ----|
//Ruta para la página de registro de métodos de pago:
Route::get('/registro-metodo-pago', [MetodoPagoController::class, 'verRegistro'])->middleware('auth')->name('registro-metodo-pago');
//Ruta para inserción de datos de métodos de pago metidos en la ruta anterior:
Route::post('/guardar-datos-metodo-pago', [MetodoPagoController::class, 'guardarDatos'])->name('guardar-datos-metodo-pago');

// |----- MOSTRAR ----|
//Ruta para listar las filas de la tabla métodos de pago
Route::get('/listado-metodos-pago', [MetodoPagoController::class, 'listar'])->middleware('auth')->name('listado-metodos-pago');

// |---- EDICIÓN -----|
//Ruta para la vista de edición de un registro la tabla métodos de pago
Route::get('/editar-metodo-pago/{metodoPago}', [MetodoPagoController::class, 'editar'])->middleware('auth')->name('editar-metodo-pago');
//Ruta para actualizar el registro editado en la vista previa
Route::put('/actualizar-metodo-pago/{metodoPago}', [MetodoPagoController::class, 'actualizar'])->name('actualizar-metodo-pago');

// |---- BORRADO -----|
//Ruta para eliminar registros de la tabla métodos de pago
Route::delete('/eliminar-metodo-pago/{metodoPago}', [MetodoPagoController::class, 'eliminar'])->name('eliminar-metodo-pago');





// |----------------> RUTAS CRUD SUSCRIPCIONES <----------------|

// |----- MOSTRAR ----|
//Ruta para listar las filas de la tabla suscripciones
Route::get('/listado-suscripciones', [SuscripcionController::class, 'listar'])->middleware('auth')->name('listado-suscripciones');

// |---- EDICIÓN -----|
//Ruta para la vista de edición de un registro la tabla suscripciones
Route::get('/editar-suscripcion/{suscripcion}', [SuscripcionController::class, 'editar'])->middleware('auth')->name('editar-suscripcion');
//Ruta para actualizar el registro editado en la vista previa
Route::put('/actualizar-suscripcion/{suscripcion}', [SuscripcionController::class, 'actualizar'])->name('actualizar-suscripcion');


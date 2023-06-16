@extends('layout.layout_dashboard')

@section('title')
<title>Editar usuario</title>
@endsection

@section('datosPlataforma')

    <div class="authentication-wrapper authentication-6 px-5">
        <div class="authentication-inner py-4">
            <h3 class="font-weight-bold py-3 mb-0">Editar usuario</h3>
            <div class="text-muted small mt-0 mb-4">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item"><a href="{{ route('listado-usuarios') }}">Usuarios</a></li>
                        <li class="breadcrumb-item active">Editar usuario</li>
                    </ol>
                </div>
            </div>
            <h4 class="font-weight-bold py-3 mb-0">Datos personales:</h4>

            <form class="my-1" method="POST" action="{{ route('actualizar-usuario', $usuario->id) }}">
                @method('PUT')
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre_usuario') is-invalid @enderror"
                            id="nombreInput" name="nombre_usuario" value="{{ $usuario->nombre_usuario }}">
                        @error('nombre_usuario')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Apellidos</label>
                        <input type="text" class="form-control @error('apellido_usuario') is-invalid @enderror"
                            id="apellidosInput" name="apellido_usuario" value="{{ $usuario->apellido_usuario }}">
                        @error('apellido_usuario')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-6">
                        <label class="form-label">Pais</label>
                        <select name="pais_id" id="inputPais" class="form-control @error('pais_id') is-invalid @enderror">
                            <option value="" selected disabled>Seleccione un país</option>
                            @foreach ($paises as $pais)
                                <option value="{{ $pais->id }}" {{ $usuario->pais_id == $pais->id ? 'selected' : '' }}>
                                    {{ $pais->nombre_pais }}</option>
                            @endforeach
                        </select>
                        @error('pais_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Ciudad</label>
                        <select name="ciudad_id" id="inputCiudad"
                            class="form-control @error('ciudad_id') is-invalid @enderror"
                            data-url="{{ route('registro-usuario') }}">
                            <option value="" selected disabled>Seleccione una ciudad</option>
                            @foreach ($ciudades as $ciudad)
                                <option value="{{ $ciudad->id }}"
                                    {{ $usuario->ciudad_id == $ciudad->id ? 'selected' : '' }}>
                                    {{ $ciudad->nombre_ciudad }}</option>
                            @endforeach
                        </select>
                        @if (session()->get('valorCiudad'))
                            <input type="hidden" value="{{ session()->get('valorCiudad') }}" id="mostrarCiudadValidacion">
                        @endif
                        @error('ciudad_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-6">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control @error('direccion_usuario') is-invalid @enderror"
                            id="direccionInput" name="direccion_usuario" value="{{ $usuario->direccion_usuario }}">
                        @error('direccion_usuario')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Código postal</label>
                        <input type="text" class="form-control @error('postal_usuario') is-invalid @enderror"
                            id="postalInput" name="postal_usuario" value="{{ $usuario->postal_usuario }}">
                        @error('postal_usuario')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="emailInput" name="email" value="{{ $usuario->email }}">
                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control @error('telefono_usuario') is-invalid @enderror"
                            id="telefonoInput" name="telefono_usuario" value="{{ $usuario->telefono_usuario }}">
                        @error('telefono_usuario')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-6">
                        <label class="form-label">Rol</label>
                        <select id="inputRol" class="form-control @error('rol_id') is-invalid @enderror"
                            name="rol_id">
                            <option value="" selected disabled>Seleccione un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" {{ $usuario->rol_id == $rol->id ? 'selected' : '' }}>
                                    {{ $rol->nombre_rol }}</option>
                            @endforeach
                        </select>
                        @error('rol_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Estado</label>
                        <select id="inputEstadoUsuario" class="form-control" name="estado_id">
                            <option value="" selected disabled>Seleccione un estado</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id }}"
                                    {{ $usuario->estado_id == $estado->id ? 'selected' : '' }}>
                                    {{ $estado->nombre_estado }}</option>
                            @endforeach
                        </select>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-4" style="text-align: center;">
                        <p class="form-label">¿Quiere cambiar la contraseña?</p>
                        <label class="form-label" for="siCambiarPassword" style="display: inline-block; margin-right: 10px;">
                            <input type="radio" id="siCambiarPassword" name="cambiarPassword" value="si">
                            Si
                        </label>
                        <label class="form-label" for="noCambiarPassword" style="display: inline-block; margin-left: 10px;">
                            <input type="radio" id="noCambiarPassword" name="cambiarPassword" value="no">
                            No
                        </label>
                        <div class="clearfix"></div>
                    </div>

                    <div class="row justify-content-center col-md-8" id="inputsCambiarContrasenia" style="display: none">
                        <div class="form-group col-md-6">
                            <label class="form-label d-flex justify-content-between align-items-end">
                                <span>Contraseña</span>
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="passwordInput" name="password" value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label d-flex justify-content-between align-items-end">
                                <span>Confirmar contraseña</span>
                            </label>
                            <input type="password" class="form-control @error('passwordConfirm') is-invalid @enderror"
                                id="passwordConfirmInput" name="passwordConfirm" value="{{ old('passwordConfirm') }}">
                            @error('passwordConfirm')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center py-3">
                    <div class="d-flex justify-content-between align-items-center m-0">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        editar();
    </script>
@endsection

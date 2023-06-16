@extends('layout.layout_dashboard')

@section('title')
<title>Registrar usuarios</title>
@endsection

@section('datosPlataforma')

    <div class="authentication-wrapper authentication-6 px-5">
        <div class="authentication-inner py-4">
            <h3 class="font-weight-bold py-3 mb-0">Registrar usuario</h3>
            <div class="text-muted small mt-0 mb-4 d-flex justify-content-between align-items-center">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item"><a href="{{ route('listado-usuarios') }}">Usuarios</a></li>
                        <li class="breadcrumb-item active">Registrar usuario</li>
                    </ol>
                </div>
            </div>
            <h4 class="font-weight-bold py-3 mb-0">Datos personales:</h4>

            <form class="my-1" method="POST" action="{{ route('guardar-datos-usuario') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre_usuario') is-invalid @enderror"
                            id="nombreInput" name="nombre_usuario" value="{{ old('nombre_usuario') }}">
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
                            id="apellidosInput" name="apellido_usuario" value="{{ old('apellido_usuario') }}">
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
                        <select name="pais_id" id="inputPais" class="form-control @error('pais_id') is-invalid @enderror"
                            name="pais_id" value="{{ old('pais_id') }}">
                            <option value="" selected disabled>Seleccione un país</option>
                            @foreach ($paises as $pais)
                                <option value="{{ $pais->id }}" {{ old('pais_id') == $pais->id ? 'selected' : '' }}>
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
                            data-url="{{ route('registro-usuario') }}" value="{{ old('ciudad_id') }}">
                            <option value="" selected disabled>Seleccione una ciudad</option>
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
                            id="direccionInput" name="direccion_usuario" value="{{ old('direccion_usuario') }}">
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
                            id="postalInput" name="postal_usuario" value="{{ old('postal_usuario') }}">
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
                            id="emailInput" name="email" value="{{ old('email') }}">
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
                            id="telefonoInput" name="telefono_usuario" value="{{ old('telefono_usuario') }}">
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
                        <label class="form-label d-flex justify-content-between align-items-end">
                            <span> Contraseña</span>
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
                        <label class="form-label">Rol</label>
                        <select id="inputRol" class="form-control @error('rol_id') is-invalid @enderror" name="rol_id"
                            value="{{ old('rol_id') }}">
                            <option value="" selected disabled>Seleccione un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
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
                </div>
                <div id="contenedorDatosSuscripcion" style="display:none">
                    @if (session()->get('validacionDatosSuscripcion'))
                        <input type="hidden" value="1" id="validacionDatosSuscripcion">
                    @endif
                    <h4 class="font-weight-bold py-3 mb-0">Datos sobre la suscripción:</h4>
                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label class="form-label">Instrumento</label>
                            <select id="inputPlan" class="form-control @error('instrumento_id') is-invalid @enderror"
                                name="instrumento_id">
                                <option value="" selected disabled>Elija uno de los instrumentos disponibles</option>
                                @foreach ($instrumentos as $instrumento)
                                <option value="{{ $instrumento->id }}" {{ old('instrumento_id') == $instrumento->id ? 'selected' : '' }}>
                                    {{ $instrumento->nombre_instrumento }}</option>
                                @endforeach
                            </select>
                            @error('instrumento_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Duración de suscripción</label>
                            <select id="inputSuscripcion"
                                class="form-control @error('duracion_suscripcion') is-invalid @enderror"
                                name="duracion_suscripcion">
                                <option value="" selected disabled>Elija la duración de su suscripción</option>
                                <option value="mes" {{ old('duracion_suscripcion') == 'mes' ? 'selected' : '' }}>30
                                    días
                                </option>
                                <option value="anio" {{ old('duracion_suscripcion') == 'anio' ? 'selected' : '' }}>12
                                    meses
                                </option>
                                <option value="personalizada"
                                    {{ old('duracion_suscripcion') == 'personalizada' ? 'selected' : '' }}>Personalizada
                                </option>
                            </select>
                            @error('duracion_suscripcion')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <div class="form-group col-md-6" id="contenedorFechaInicio" style="display:none">
                            <label class="form-label">Fecha de inicio</label>
                            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror"
                                id="fechaInicio" name="fecha_inicio" value="{{ date('Y-m-d') }}">

                            @if (session()->get('validacionFechas'))
                                <input type="hidden" value="1" id="validacionFechas">
                            @endif

                            @error('fecha_inicio')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group col-md-6" id="contenedorFechaExpiracion" style="display:none">
                            <label class="form-label">Fecha de expiración</label>
                            <input type="date" class="form-control @error('fecha_expiracion') is-invalid @enderror"
                                id="fechaInicio" name="fecha_expiracion" value="{{ old('fecha_expiracion') }}">
                            @error('fecha_expiracion')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="form-group col-md-6">
                            <label class="form-label">Número de operación de pago</label>
                            <input type="text" class="form-control @error('numero_operacion_pago') is-invalid @enderror"
                                id="numeroOperacionPagoInput" name="numero_operacion_pago" value="{{ old('numero_operacion_pago') }}">
                            @error('numero_operacion_pago')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Método de pago</label>
                            <select id="inputMetodoPago" class="form-control @error('metodo_pago_id') is-invalid @enderror" name="metodo_pago_id"
                            value="{{ old('metodo_pago_id') }}">
                            <option value="" selected disabled>Seleccione un método de pago</option>
                            @foreach ($metodosPago as $metodoPago)
                                <option value="{{ $metodoPago->id }}" {{ old('metodo_pago_id') == $metodoPago->id ? 'selected' : '' }}>
                                    {{ $metodoPago->medio_pago }}</option>
                            @endforeach
                        </select>
                        @error('rol_id')
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
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    
@endsection

@section('script')
<script>
    registrar();
</script>
@endsection

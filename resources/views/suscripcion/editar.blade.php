@extends('layout.layout_dashboard')

@section('title')
    <title>Editar suscripción</title>
@endsection

@section('datosPlataforma')

    <div class="authentication-wrapper authentication-6 px-5">
        <div class="authentication-inner py-4">
            <h3 class="font-weight-bold py-3 mb-0">Editar suscripción</h3>
            <div class="text-muted small mt-0 mb-4 d-flex justify-content-between align-items-center">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item"><a href="{{ route('listado-suscripciones') }}">Suscripciones</a></li>
                        <li class="breadcrumb-item active">Editar suscripción</li>
                    </ol>
                </div>
            </div>

            <form class="my-1" method="POST" action="{{ route('actualizar-suscripcion', $suscripcion->id) }}">
                @method('PUT')
                @csrf

                <div class="row justify-content-center">
                    <div class="form-group col-md-6">
                        <label class="form-label">Nombre completo</label>
                        <input disabled type="text" class="form-control" id="nombreInput" name="nombre_usuario"
                            value="{{ $usuarios->nombre_usuario . ' ' . $usuarios->apellido_usuario }}">
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Estado</label>
                        <select id="inputEstadoUsuario" class="form-control" name="estado_id">
                            <option value="" selected disabled>Seleccione un estado</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id }}"
                                    {{ $suscripcion->estado_id == $estado->id ? 'selected' : '' }}>
                                    {{ $estado->nombre_estado }}</option>
                            @endforeach
                        </select>
                        <div class="clearfix"></div>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="form-group col-md-4" style="text-align: center;">
                        <p class="form-label">¿Quiere renovar la suscripción?</p>
                        <label class="form-label" for="siRenovarSuscripcion"
                            style="display: inline-block; margin-right: 10px;">
                            <input type="radio" id="siRenovarSuscripcion" name="renovarSuscripcion" value="si">
                            Si
                        </label>
                        <label class="form-label" for="noRenovarSuscripcion"
                            style="display: inline-block; margin-left: 10px;">
                            <input type="radio" id="noRenovarSuscripcion" name="renovarSuscripcion" value="no">
                            No
                        </label>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div id="renovarSuscripcion" style="display:none">
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

                        <div class="form-group col-md-3" id="contenedorFechaExpiracion" style="display:none">
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
                            <input type="text"
                                class="form-control @error('numero_operacion_pago') is-invalid @enderror"
                                id="numeroOperacionPagoInput" name="numero_operacion_pago"
                                value="{{ old('numero_operacion_pago') }}">
                            @error('numero_operacion_pago')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Método de pago</label>
                            <select id="inputMetodoPago"
                                class="form-control @error('metodo_pago_id') is-invalid @enderror" name="metodo_pago_id"
                                value="{{ old('metodo_pago_id') }}">
                                <option value="" selected disabled>Seleccione un método de pago</option>
                                @foreach ($metodosPago as $metodoPago)
                                    <option value="{{ $metodoPago->id }}"
                                        {{ old('metodo_pago_id') == $metodoPago->id ? 'selected' : '' }}>
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
                        <button type="submit" class="btn btn-primary">Actualizar suscripcion</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        edicionSuscripciones();
    </script>
@endsection

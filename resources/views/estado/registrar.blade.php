@extends('layout.layout_dashboard')

@section('title')
<title>Registrar estados</title>
@endsection

@section('datosPlataforma')

    <div class="authentication-wrapper authentication-6 px-5">
        <div class="authentication-inner py-4">
            <h3 class="font-weight-bold py-3 mb-0">Registrar estado</h3>
            <div class="text-muted small mt-0 mb-4 d-flex justify-content-between align-items-center">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item"><a href="{{ route('listado-estados') }}">Estados</a></li>
                        <li class="breadcrumb-item active">Registrar estado</li>
                    </ol>
                </div>
            </div>

            <form class="my-1" method="POST" action="{{ route('guardar-datos-estado') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-md">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre_estado') is-invalid @enderror"
                            id="nombreEstadoInput" name="nombre_estado" value="{{ old('nombre_estado') }}">
                        @error('nombre_estado')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row justify-content-center py-3">
                    <div class="d-flex justify-content-between align-items-center m-0">
                        <button type="submit" class="btn btn-primary">Registrar estado</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

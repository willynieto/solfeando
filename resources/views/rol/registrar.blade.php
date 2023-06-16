@extends('layout.layout_dashboard')

@section('title')
<title>Registrar roles</title>
@endsection

@section('datosPlataforma')

    <div class="authentication-wrapper authentication-6 px-5">
        <div class="authentication-inner py-4">
            <h3 class="font-weight-bold py-3 mb-0">Registrar rol</h3>
            <div class="text-muted small mt-0 mb-4 d-flex justify-content-between align-items-center">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item"><a href="{{ route('listado-roles') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Registrar rol</li>
                    </ol>
                </div>
            </div>

            <form class="my-1" method="POST" action="{{ route('guardar-datos-rol') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-md">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre_rol') is-invalid @enderror"
                            id="nombreRolInput" name="nombre_rol" value="{{ old('nombre_rol') }}">
                        @error('nombre_rol')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row justify-content-center py-3">
                    <div class="d-flex justify-content-between align-items-center m-0">
                        <button type="submit" class="btn btn-primary">Registrar rol</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    
@endsection

@extends('layout.layout_dashboard')

@section('title')
<title>Editar estado</title>
@endsection

@section('datosPlataforma')

    <div class="authentication-wrapper authentication-6 px-5">
        <div class="authentication-inner py-4">
            <h3 class="font-weight-bold py-3 mb-0">Editar estado</h3>
            <div class="text-muted small mt-0 mb-4 d-flex justify-content-between align-items-center">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item"><a href="{{ route('listado-estados') }}">Estados</a></li>
                        <li class="breadcrumb-item active">Editar estado</li>
                    </ol>
                </div>
            </div>
            <!-- [ Form ] Start -->
            <form class="my-1" method="POST" action="{{ route('actualizar-estado', $estado->id) }}">
                @method('PUT')
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-md">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre_estado') is-invalid @enderror"
                            id="nombreEstadosInput" name="nombre_estado" value="{{ $estado->nombre_estado }}">
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
                        <button type="submit" class="btn btn-primary">Actualizar estado</button>
                    </div>
                </div>
            </form>
            <!-- [ Form ] End -->

        </div>
    </div>
    <!-- [ content ] End -->
@endsection

@extends('layout.layout_dashboard')

@section('title')
<title>Editar ciudad</title>
@endsection

@section('datosPlataforma')
    <div class="authentication-wrapper authentication-6 px-5">
        <div class="authentication-inner py-4">
            <h3 class="font-weight-bold py-3 mb-0">Editar ciudad</h3>
            <div class="text-muted small mt-0 mb-4 d-flex justify-content-between align-items-center">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item"><a href="{{ route('listado-ciudades') }}">Ciudades</a></li>
                        <li class="breadcrumb-item active">Editar ciudad</li>
                    </ol>
                </div>
            </div>

            <form class="my-1" method="POST" action="{{ route('actualizar-ciudad', $ciudad->id) }}">
                @method('PUT')
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre_ciudad') is-invalid @enderror"
                            id="nombreCiudadInput" name="nombre_ciudad" value="{{ $ciudad->nombre_ciudad }}">
                        @error('nombre_ciudad')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Pais</label>
                        <select name="pais_id" id="inputPais" class="form-control @error('pais_id') is-invalid @enderror">
                            <option value="" selected disabled>Seleccione un país</option>
                            @foreach ($paises as $pais)
                                <option value="{{ $pais->id }}" {{ $ciudad->pais_id == $pais->id ? 'selected' : '' }}>
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
                </div>
                <div class="row justify-content-center py-3">
                    <div class="d-flex justify-content-between align-items-center m-0">
                        <button type="submit" class="btn btn-primary">Actualizar ciudad</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

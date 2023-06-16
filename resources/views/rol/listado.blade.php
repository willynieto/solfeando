@extends('layout.layout_dashboard')

@section('title')
<title>Maestro de roles</title>
@endsection

@section('estilos')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/listado.css') }}">
@endsection

@section('datosPlataforma')

    <div class="layout-content">

        <div class="container-fluid flex-grow-1 container-p-y">

            <h3 class="font-weight-bold py-3 mb-0">Maestro de roles</h3>
            <div class="text-muted small mt-0 mb-4 d-flex justify-content-between align-items-center">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
                <a href="{{ route('registro-rol') }}" class="btn btn-success feather icon-bookmark"><strong>+</strong></a>
            </div>

            @if (session('exitoCreado'))
                <div class="alert alert-success d-flex align-items-center" role="alert" style="color: #11573b">
                    <i class="sidenav-icon feather icon-check"></i>
                    <div>
                        {{ session('exitoCreado') }}
                    </div>
                </div>
            @endif

            @if (session('exitoActualizado'))
                <div class="alert alert-success d-flex align-items-center" role="alert" style="color: #11573b">
                    <i class="sidenav-icon feather icon-check"></i>
                    <div>
                        {{ session('exitoActualizado') }}
                    </div>
                </div>
            @endif

            @if (session('exitoBorrado'))
                <div class="alert alert-warning d-flex align-items-center" role="alert" style="color: #b47833">
                    <i class="sidenav-icon feather icon-trash-2"></i>
                    <div>
                        {{ session('exitoBorrado') }}
                    </div>
                </div>
            @endif

            <div class="card table table-responsive p-3">
                <table id="roles" class="table card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $rol)
                            <tr>
                                <td>{{ $rol->id }}</td>
                                <td>{{ $rol->nombre_rol}}</td>
                                <td>
                                    <a href="{{ route('editar-rol', $rol->id) }}"
                                        class="btn btn-warning feather icon-edit-1 m-1" style="display: inline-block;"></a>
                                    <form method="POST" action="{{ route('eliminar-rol', $rol->id) }}"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger feather icon-trash-2 m-1"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layout.layout_dashboard')

@section('title')
<title>Maestro de usuarios</title>
@endsection

@section('datosPlataforma')

    <div class="layout-content">

        <div class="container-fluid flex-grow-1 container-p-y">

            <h3 class="font-weight-bold py-3 mb-0">Maestro de usuarios</h3>
            <div class="text-muted small mt-0 mb-4 d-flex justify-content-between align-items-center">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
                <a href="{{ route('registro-usuario') }}" class="btn btn-success feather icon-user-plus"></a>
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
                <table id="usuarios" class="table card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->nombre_usuario . ' ' . $usuario->apellido_usuario }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->nombre_rol }}</td>
                                @if ($usuario->estado_id == '1')
                                    <td style="color: #62d493"><strong>{{ $usuario->nombre_estado }}</strong></td>
                                @elseif ($usuario->estado_id == '2')
                                    <td style="color: #f35454"><strong>{{ $usuario->nombre_estado }}</strong></td>
                                @elseif ($usuario->estado_id == '3')
                                    <td style="color: #f3ab54"><strong>{{ $usuario->nombre_estado }}</strong></td>
                                @elseif ($usuario->estado_id == '5')
                                    <td style="color: #5464f3"><strong>{{ $usuario->nombre_estado }}</strong></td>
                                @endif
                                <td>
                                    <a href="{{ route('editar-usuario', $usuario->id) }}"
                                        class="btn btn-warning feather icon-edit-1 m-1" style="display: inline-block;"></a>
                                    <form method="POST" action="{{ route('eliminar-usuario', $usuario->id) }}"
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

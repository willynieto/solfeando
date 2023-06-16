@extends('layout.layout_dashboard')

@section('title')
    <title>Suscripciones</title>
@endsection

@section('estilos')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/estiloDiasRestantesSuscripcion.css') }}">
@endsection

@section('datosPlataforma')

    <div class="layout-content">

        <div class="container-fluid flex-grow-1 container-p-y">

            <h3 class="font-weight-bold py-3 mb-0">Suscripciones</h3>
            <div class="text-muted small mt-0 mb-4 d-flex justify-content-between align-items-center">
                <div class="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Configuración</li>
                        <li class="breadcrumb-item active">Suscripciones</li>
                    </ol>
                </div>
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
                <table id="suscripciones" class="table card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre completo</th>
                            <th>Fecha inicio</th>
                            <th>Fecha expiración</th>
                            <th>Instrumento</th>
                            <th>Días restantes</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suscripciones as $suscripcion)
                            <tr>
                                <td>{{ $suscripcion->nombre_usuario . " " . $suscripcion->apellido_usuario }}</td>

                                <td>{{ $suscripcion->fecha_inicio->format('d-m-Y') }}</td>
                                <td>{{ $suscripcion->fecha_expiracion->format('d-m-Y') }}</td>
                                <td>{{ $suscripcion->nombre_instrumento }}</td>
                                <td class="dias"><strong>{{ $suscripcion->dias_suscripcion }}</strong></td>
                                @if ($suscripcion->estado_id == '1')
                                    <td style="color: #62d493"><strong>{{ $suscripcion->nombre_estado }}</strong></td>
                                @elseif ($suscripcion->estado_id == '2')
                                    <td style="color: #f35454"><strong>{{ $suscripcion->nombre_estado }}</strong></td>
                                @elseif ($suscripcion->estado_id == '3')
                                    <td style="color: #f3ab54"><strong>{{ $suscripcion->nombre_estado }}</strong></td>
                                @elseif ($suscripcion->estado_id == '5')
                                    <td style="color: #5464f3"><strong>{{ $suscripcion->nombre_estado }}</strong></td>
                                @elseif ($suscripcion->estado_id == '6')
                                    <td style="color: #f35454"><strong>{{ $suscripcion->nombre_estado }}</strong></td>
                                @endif
                                <td>
                                    <a href="{{ route('editar-suscripcion', $suscripcion->id) }}"
                                        class="btn btn-warning feather icon-edit-1 m-1" style="display: inline-block;"></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>#</td>
                                <td>No hay datos para mostrar</td>
                                <td>#</td>
                                <td>#</td>
                                <td>#</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.dias').each(function() {
                var dias = $(this).text().trim();
                if (dias.startsWith('-') || dias.startsWith('0')) {
                    $(this).addClass('rojo');
                } else {
                    $(this).addClass('verde');
                }
            });
        });
    </script>
@endsection

<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">

    <div class="app-brand demo">
        <span class="app-brand-logo demo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Brand Logo" class="img-fluid">
        </span>
        <a href="index.html" class="app-brand-text demo sidenav-text font-weight-normal ml-2">Solfeando</a>
        <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
            <i class="ion ion-md-menu align-middle"></i>
        </a>
    </div>
    <div class="sidenav-divider mt-0"></div>

    <ul class="sidenav-inner py-1">

        <li class="sidenav-item active">
            <a href="{{ route('inicio') }}" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Inicio</div>
            </a>
        </li>

        @auth
            @if (Auth::user()->rol_id == 1)

                <li class="sidenav-divider mb-1"></li>
                
                <li class="sidenav-header small font-weight-semibold">Configuración</li>
                <li class="sidenav-item">
                    <a href="{{ route('listado-usuarios') }}" class="sidenav-link">
                        <i class="sidenav-icon feather icon-users"></i>
                        <div>Usuarios</div>
                    </a>
                    <a href="{{ route('listado-suscripciones') }}" class="sidenav-link">
                        <i class="sidenav-icon feather icon-shopping-cart"></i>
                        <div>Suscripciones</div>
                    </a>
                    <a href="{{ route('listado-roles') }}" class="sidenav-link">
                        <i class="sidenav-icon feather icon-bookmark"></i>
                        <div>Roles</div>
                    </a>
                    <a href="{{ route('listado-paises') }}" class="sidenav-link">
                        <i class="sidenav-icon feather icon-flag"></i>
                        <div>Paises</div>
                    </a>
                    <a href="{{ route('listado-ciudades') }}" class="sidenav-link">
                        <i class="sidenav-icon feather icon-map"></i>
                        <div>Ciudades</div>
                    </a>
                    <a href="{{ route('listado-estados') }}" class="sidenav-link">
                        <i class="sidenav-icon feather icon-activity"></i>
                        <div>Estados</div>
                    </a>
                    <a href="{{ route('listado-metodos-pago') }}" class="sidenav-link">
                        <i class="sidenav-icon feather icon-credit-card"></i>
                        <div>Métodos de pago</div>
                    </a>
                </li>
            @endif
        @endauth


    </ul>
</div>

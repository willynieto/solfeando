<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('title')

    <!-- Icono -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- Fuentes Google -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/open-iconic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/pe-icon-7-stroke.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shreerang-material.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/flot/flot.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/authentication.css') }}">

    <!-- Estilo para el listado de tablas -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables/dataTables.bootstrap4.min.css') }}">

    @yield('estilos')

</head>

<body>

    @include('layout._partials.preloader')

    <div class="layout-wrapper layout-2">
        <div class="layout-inner">

            @include('layout._partials.sidenav')

            <div class="layout-container">

                @include('layout._partials.navbar')

                <div class="layout-content">

                    @yield('datosPlataforma')

                    @include('layout._partials.footer')

                </div>

            </div>
        </div>

        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>

    <!-- Scripts plantilla -->
    <script src="{{ asset('assets/js/pace.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/sidenav.js') }}"></script>
    <script src="{{ asset('assets/js/layout-helpers.js') }}"></script>
    <script src="{{ asset('assets/js/material-ripple.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>

    <!-- Funcionalidad dashboard (sidebar y navbar) -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>

    <!-- Archivo JS para funcionalidades con JQuery -->
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>

    <!-- Scrits para crear listas -->
    <script src="{{ asset('assets/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables/dataTable.js') }}"></script>

    @yield('script')

</body>

</html>

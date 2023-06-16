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

    <!-- Fuentes google -->
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

    @yield('estilos')

</head>

<body>
    
    @yield('contenido')

    <!-- Scripts -->
    <script src="{{ asset('assets/js/pace.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/sidenav.js') }}"></script>
    <script src="{{ asset('assets/js/layout-helpers.js') }}"></script>
    <script src="{{ asset('assets/js/material-ripple.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/libs/eve/eve.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/flot.js') }}"></script>
    <script src="{{ asset('assets/libs/flot/curvedLines.js') }}"></script>
    <script src="{{ asset('assets/libs/chart-am4/core.js') }}"></script>
    <script src="{{ asset('assets/libs/chart-am4/charts.js') }}"></script>
    <script src="{{ asset('assets/libs/chart-am4/animated.js') }}"></script>

    <!-- Funcionalidad dashboard (sidebar y navbar) -->
    <script src="{{ asset('assets/js/pages/dashboards_index.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>

</body>

</html>

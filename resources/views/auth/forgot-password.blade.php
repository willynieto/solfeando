@extends('layout.layout_auth')

@section('title')
    <title>Recuperar contraseña</title>
@endsection

@section('datosPlataforma')
    @include('layout._partials.preloader')

    <!-- [ content ] Start -->
    <div class="authentication-wrapper authentication-1 px-4">
        <div class="authentication-inner py-5">

            <!-- [ Logo ] Start -->
            <div class="d-flex justify-content-center align-items-center">
                <div class="ui-w-60">
                    <div class="w-100 position-relative">
                        <img src="assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid">
                    </div>
                </div>
            </div>
            <!-- [ Logo ] End -->

            <div class="mt-4 mb-5" style="text-align: center">
                <p><strong>¿Olvidaste tu contraseña?</strong> Ingresa tu email registrado, y obtén el enlace para restablecerla y elegir una
                    nueva.</p>
            </div>

            <!-- Session Status -->

            @if(session('status'))
                <div class="alert alert-success d-flex align-items-center" role="alert" style="color: #11573b">
                    <i class="sidenav-icon feather icon-check"></i>
                    <div>
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <!-- [ Form ] Start -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" id="emailInput" name="email" value="{{ old('email') }}"
                        required autofocus>
                    <div class="clearfix"></div>
                </div>

                <div class="row justify-content-center py-4">
                    <div class="d-flex justify-content-between align-items-center m-0">
                        <button type="submit" class="btn btn-primary">Enviar correo</button>
                    </div>
                </div>
            </form>
            <!-- [ Form ] End -->


        </div>
    </div>
    <!-- [ content ] End -->
@endsection

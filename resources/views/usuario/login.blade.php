@extends('layout.layout_auth')

@section('title')
    <title>Iniciar sesión</title>
@endsection

@section('datosPlataforma')
    @include('layout._partials.preloader')

    <div class="authentication-wrapper authentication-1 px-4">
        <div class="authentication-inner py-5">

            <div class="d-flex justify-content-center align-items-center py-3">
                <div class="ui-w-60">
                    <div class="w-100 position-relative">
                        <img src="assets/img/logo-dark.png" alt="Brand Logo" class="img-fluid">
                    </div>
                </div>
            </div>

            @if(session('status'))
                <div class="alert alert-success d-flex align-items-center" role="alert" style="color: #11573b">
                    <i class="sidenav-icon feather icon-check"></i>
                    <div>
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <form class="my-3" method="POST" action="{{ route('inicia-sesion') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" id="emailInput" name="email">
                    @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="form-label d-flex justify-content-between align-items-end">
                        <span>Contraseña</span>
                    </label>
                    <input type="password" class="form-control" id="passwordInput" name="password">
                    @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="clearfix"></div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" style="padding-left: -60px !important" id="rememberCheck" name="remember">
                            <span class="custom-control-label">Mantener sesión iniciada</span>
                        </label>
                    </div>
                </div>
                <div class="row justify-content-center py-4">
                    <div class="d-flex justify-content-between align-items-center m-0">
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <a href="{{ route('password.request') }}" class="d-block">¿Has olvidado tu contraseña?</a>
                </div>

            </form>

        </div>
    </div>

@endsection

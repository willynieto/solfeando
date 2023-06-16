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
            <div class="d-flex justify-content-center align-items-center py-4">
                <div class="ui-w-60">
                    <div class="w-100 position-relative">
                        <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Brand Logo" class="img-fluid">
                    </div>
                </div>
            </div>
            <!-- [ Logo ] End -->

            <!-- Session Status -->

            @if (session('status'))
                <div class="alert alert-success d-flex align-items-center" role="alert" style="color: #11573b">
                    <i class="sidenav-icon feather icon-check"></i>
                    <div>
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group" style="display: none;">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" id="emailInput" name="email" value="{{ $request->email }}"
                        required>
                    <div class="clearfix"></div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('email') }}"
                        required autocomplete="new-password">
                    <div class="clearfix"></div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                    <div class="clearfix"></div>
                </div>

                <div class="row justify-content-center py-4">
                    <div class="d-flex justify-content-between align-items-center m-0">
                        <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- [ content ] End -->
@endsection

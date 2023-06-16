@extends('layout.layout_inicio')

@section('contenido')
    @include('layout._partials.preloader')

    <div class="layout-wrapper layout-2">
        <div class="layout-inner">

            @include('layout._partials.sidenav')

            <div class="layout-container">

                @include('layout._partials.navbar')

                <div class="layout-content">

                    @include('layout._partials.contentdashboard')

                    @include('layout._partials.footer')

                </div>

            </div>

        </div>

        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>

@endsection

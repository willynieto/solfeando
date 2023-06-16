<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Inicio</h4>
    <div class="row">

        @auth
            @if (Auth::user()->rol_id == 1)

                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                    <h2 class="mb-2">{{ $cantidadAlumnos }}</h2>
                                    <p class="mb-0"><span class="badge badge-primary">Alumnos</span></p>
                                </div>
                                <div class="lnr lnr-graduation-hat display-4 text-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                    <h2 class="mb-2">{{ $cantidadProfesores }}</h2>
                                    <p class="text-muted mb-0"><span class="badge badge-success">Profesores</span></p>
                                </div>
                                <div class="lnr lnr-license display-4 text-success"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                    <h2 class="mb-2">{{ $cantidadInstrumentos }}</h2>
                                    <p class="text-muted mb-0"><span class="badge badge-danger">Instrumentos</span>
                                    </p>
                                </div>
                                <div class="lnr lnr-music-note display-4 text-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        @endauth

    </div>

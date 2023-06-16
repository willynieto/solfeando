
//Función para la vista de edición de usuario
function editar() {
    $(document).ready(function () {

        $('#inputPais').on("change", function () {

            var datoPaisID = $('#inputPais').val();

            var html_select = '<option value="" selected disabled>Selecciona una ciudad</option>';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '../pais/' + datoPaisID + '/ciudades',
                data: { paisID: datoPaisID },
                dataType: 'json',
                success: function (data) {
                    //Función map se utiliza para entrar en un array dentro de un array
                    data.map((ciudades) => {
                        for (var i = 0; i < ciudades.length; ++i)
                            html_select += '<option value="' + ciudades[i].id + '">' + ciudades[i].nombre_ciudad + '</option>';
                        $('#inputCiudad').html(html_select);
                    });
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }

            });

        });

        $('#siCambiarPassword').on("change", function () {
            mostrarCambioContrasenia();
        });

        $('#noCambiarPassword').on("change", function () {
            mostrarCambioContrasenia();
        });

        function mostrarCambioContrasenia() {
            if ($('#siCambiarPassword').is(':checked')) {
                $('#inputsCambiarContrasenia').show('fast');
            } else if ($('#noCambiarPassword').is(':checked')) {
                $('#inputsCambiarContrasenia').hide('fast');
            }
        }

    });
}

//Función para la vista de registro de usuario
function registrar() {
    $(document).ready(function () {

        $('#inputPais').on("change", function () {

            var datoPaisID = $('#inputPais').val();

            var html_select = '<option value="" selected disabled>Selecciona una ciudad</option>';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'pais/' + datoPaisID + '/ciudades',
                data: { paisID: datoPaisID },
                dataType: 'json',
                success: function (data) {
                    //Función map se utiliza para entrar en un array dentro de un array
                    data.map((ciudades) => {
                        for (var i = 0; i < ciudades.length; ++i)
                            html_select += '<option value="' + ciudades[i].id + '">' + ciudades[i].nombre_ciudad + '</option>';
                        $('#inputCiudad').html(html_select);
                    });
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }

            });

        });

        //Leyendo value de un input hidden para mostrar las ciudades de pais después de ser validado
        var mostrarCiudadValidacion = $('#mostrarCiudadValidacion').val();

        if (mostrarCiudadValidacion !== 0) {
            var datoPaisID = $('#inputPais').val();

            var html_select = '<option value="" selected disabled>Seleccione una ciudad</option>';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'pais/' + datoPaisID + '/ciudades',
                data: { paisID: datoPaisID },
                dataType: 'json',
                success: function (data) {
                    //Función map se utiliza para entrar en un array dentro de un array
                    data.map((ciudades) => {
                        for (var i = 0; i < ciudades.length; ++i)
                            html_select += '<option value="' + ciudades[i].id + '">' + ciudades[i].nombre_ciudad + '</option>';
                        $('#inputCiudad').html(html_select);
                    });
                    $("#inputCiudad option[value=" + mostrarCiudadValidacion + "]").attr("selected", true);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }

            });
        }


        //Leyendo value de un input hidden para mostrar los campos 'fecha_inicio' y 'fecha_expiracion' después de ser validados
        var validacionFechas = $('#validacionFechas').val();

        if (validacionFechas == '1') {
            $("#contenedorFechaInicio").show('fast');
            $("#contenedorFechaExpiracion").show('fast');
        }


        $('#inputSuscripcion').on("change", function () {
            var duracionSuscripcion = $('#inputSuscripcion').val();

            switch (duracionSuscripcion) {
                case 'mes':
                    $("#contenedorFechaInicio").hide('fast');
                    $("#contenedorFechaExpiracion").hide('fast');
                    break;
                case 'anio':
                    $("#contenedorFechaInicio").hide('fast');
                    $("#contenedorFechaExpiracion").hide('fast');
                    break;
                case 'personalizada':
                    $("#contenedorFechaInicio").show('fast');
                    $("#contenedorFechaExpiracion").show('fast');
                    break;
            }

            ajustarFormulario();
        });

        $('#inputRol').on("change", function () {

            var rolSeleccionado = $('#inputRol').val();

            switch (rolSeleccionado) {
                case '1':
                    $("#contenedorDatosSuscripcion").hide('fast');
                    break;
                case '2':
                    $("#contenedorDatosSuscripcion").show('fast');
                    break;
                case '3':
                    $("#contenedorDatosSuscripcion").show('fast');
                    break;
            }
        });

        var validacionDatosSuscripcion = $('#validacionDatosSuscripcion').val();

        if (validacionDatosSuscripcion == '1') {
            $("#contenedorDatosSuscripcion").show('fast');
        }

    });

}


function edicionSuscripciones() {
    $(document).ready(function () {

        $('input[name="renovarSuscripcion"]').click(function () {
            // Obtener el valor del radio button seleccionado
            var renovarSuscripcion = $('input[name="renovarSuscripcion"]:checked').val();

            // Verificar si el valor es "si"
            if (renovarSuscripcion === "si") {
                // Desactivar el input de estado
                $('#inputEstadoUsuario').prop('disabled', true);
            } else {
                // Activar el input de estado
                $('#inputEstadoUsuario').prop('disabled', false);
            }
        });

        function ajustarFormulario() {
            var cantidadCondominios = $("#cantidadCondominios");
            var contenedorFechaExpiracion = $("#contenedorFechaExpiracion");

            var planSuscripcion = $('#inputPlan').val();
            var duracionSuscripcion = $('#inputSuscripcion').val();

            if (planSuscripcion == 'mas10' && $("#contenedorFechaExpiracion").is(':hidden')) {
                cantidadCondominios.removeClass();
                cantidadCondominios.addClass("form-group col-md-12");
            } if (duracionSuscripcion == 'personalizada' && $("#cantidadCondominios").is(':hidden')) {
                contenedorFechaExpiracion.removeClass();
                contenedorFechaExpiracion.addClass("form-group col-md-12");
            } if (planSuscripcion == 'mas10' && duracionSuscripcion == 'personalizada') {
                cantidadCondominios.removeClass();
                contenedorFechaExpiracion.removeClass();
                cantidadCondominios.addClass("form-group col-md-6");
                contenedorFechaExpiracion.addClass("form-group col-md-6");
            }
        }

        function mostrarRenovacionSuscripcion() {
            if ($('#siRenovarSuscripcion').is(':checked')) {
                $('#renovarSuscripcion').show('fast');
            } else if ($('#noRenovarSuscripcion').is(':checked')) {
                $('#renovarSuscripcion').hide('fast');
            }
        }

        $('#siRenovarSuscripcion').on("change", function () {
            mostrarRenovacionSuscripcion();
        });

        $('#noRenovarSuscripcion').on("change", function () {
            mostrarRenovacionSuscripcion();
        });


        //Mostrar formularios extra dependiendo de las opciones marcadas por el usuario en la sección de suscripción
        $('#inputPlan').on("change", function () {

            var planSuscripcion = $('#inputPlan').val();

            switch (planSuscripcion) {
                case '1':
                    $("#cantidadCondominios").hide('fast');
                    break;
                case '5':
                    $("#cantidadCondominios").hide('fast');
                    break;
                case '10':
                    $("#cantidadCondominios").hide('fast');
                    break;
                case 'mas10':
                    $("#cantidadCondominios").show('fast');
                    break;
            }

            ajustarFormulario();
        });

        $('#inputSuscripcion').on("change", function () {
            var duracionSuscripcion = $('#inputSuscripcion').val();

            switch (duracionSuscripcion) {
                case 'mes':
                    $("#contenedorFechaExpiracion").hide('fast');
                    break;
                case 'anio':
                    $("#contenedorFechaExpiracion").hide('fast');
                    break;
                case 'personalizada':
                    $("#contenedorFechaExpiracion").show('fast');
                    break;
            }

            ajustarFormulario();
        });


        ajustarFormulario();

    });
}


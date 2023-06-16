<?php

namespace App\Console;

use App\Http\Controllers\NotificacionesController;
use App\Models\Suscripciones\Persistencia\SuscripcionesPersis;
use App\Models\Usuarios\Persistencia\UsuariosPersis;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            try {
                $suscripcionPersis = new SuscripcionesPersis();
                $suscripcionPersis->actualizarDiasRestantesSuscripcion();
                $suscripcionPersis->controlarEstadoSuscripcion();

                $usuarioPersis = new UsuariosPersis();
                $usuarioPersis->controlarEstadoUsuario();

                $suscripciones = $suscripcionPersis->consultarSuscripciones();

                $notificacionesController = new NotificacionesController();

                $notificacionesController->notificarDiasRestantesSuscripcion($suscripciones);

            } catch (\Exception $e) {
                Log::info('Hubo un error al controlar dias de suscripcion y estados: ' . $e->getMessage());
            }
        })->dailyAt('21:28');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast; // <-- Asegúrate de que esté esta línea

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 🚀 ESTA LÍNEA DESTRABA LOS CANALES PRIVADOS EN LARAVEL 11/12/13
        Broadcast::routes(); 

        // Carga automática de los canales
        require base_path('routes/channels.php');
    }
}

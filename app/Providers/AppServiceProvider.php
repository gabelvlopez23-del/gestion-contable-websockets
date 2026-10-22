<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Activa el ruteo básico de transmisión para WebSockets
        Broadcast::routes();

        // Carga el archivo de canales de tu proyecto
        require base_path('routes/channels.php');
    }
}

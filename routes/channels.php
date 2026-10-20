<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('empresa.{empresaId}', function ($user, $empresaId) {
    return true; // Acceso total temporal para la defensa del TP
});

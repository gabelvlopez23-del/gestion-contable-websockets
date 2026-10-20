<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContabilidadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rutas para los reportes contables del sistema
Route::get('/contabilidad/libro-diario', [ContabilidadController::class, 'libroDiario']);
Route::get('/contabilidad/libro-mayor/{cuenta_id}', [ContabilidadController::class, 'libroMayor']);
Route::get('/contabilidad/sumas-y-saldos', [ContabilidadController::class, 'sumasYSaldos']);

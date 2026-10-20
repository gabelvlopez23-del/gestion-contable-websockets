<?php

use App\Http\Controllers\ContabilidadController;
use Illuminate\Support\Facades\Route;

// 1. Ruta de bienvenida (El Dashboard donde pusimos el JavaScript)
Route::get('/', function () {
    return view('welcome');
});

// 2. Ruta para procesar el Balance de Sumas y Saldos en el controlador
Route::get('/contabilidad/sumas-y-saldos', [ContabilidadController::class, 'sumasYSaldos']);

// 3. Ruta auxiliar para cargar asientos que tenías en tu pantalla
Route::get('/contabilidad/cargar-asiento', function () {
    $cuentas = \App\Models\PlanCuenta::where('recibe_asientos', true)->get();
    return view('cargar_asiento', compact('cuentas'));
});

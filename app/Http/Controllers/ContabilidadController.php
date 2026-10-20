<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsientoCabecera;
use App\Models\AsientoLinea;
use App\Models\PlanCuenta;
use Illuminate\Support\Facades\DB;
use App\Events\NotificationBalanceReady; // Importación correcta del evento arriba

class ContabilidadController extends Controller
{
    // 1. REPORTES: LIBRO DIARIO
    public function libroDiario()
    {
        $asientos = AsientoCabecera::with('lineas.cuenta')
            ->orderBy('fecha', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json($asientos);
    }

    // 2. REPORTES: LIBRO MAYOR (Historial de una cuenta específica)
    public function libroMayor($cuentaId)
    {
        $movimientos = AsientoLinea::with('cabecera')
            ->where('plan_cuenta_id', $cuentaId)
            ->get();

        return response()->json($movimientos);
    }

    // 3. REPORTES: BALANCE DE SUMAS Y SALDOS
    public function sumasYSaldos()
    {
        // Traemos todas las cuentas contables que reciben asientos
        $cuentas = PlanCuenta::where('recibe_asientos', true)->get();

        $reporte = $cuentas->map(function($cuenta) {
            // Calculamos la suma total de los movimientos de la cuenta
            $suma_debe = AsientoLinea::where('plan_cuenta_id', $cuenta->id)->sum('debe');
            $suma_haber = AsientoLinea::where('plan_cuenta_id', $cuenta->id)->sum('haber');

            $saldoDeudor = 0;
            $saldoAcreedor = 0;

            if ($suma_debe > $suma_haber) {
                $saldoDeudor = $suma_debe - $suma_haber;
            } else {
                $saldoAcreedor = $suma_haber - $suma_debe;
            }

            return [
                'codigo'          => $cuenta->codigo,
                'cuenta'          => $cuenta->nombre,
                'suma_debe'       => $suma_debe,
                'suma_haber'      => $suma_haber,
                'saldo_deudor'    => $saldoDeudor,
                'saldo_acreedor'  => $saldoAcreedor,
            ];
        });

        // 🚀 INYECCIÓN DEL WEBSOCKET: Dentro de la función, justo antes de retornar la respuesta
        $empresaId = 1; // ID de ejemplo de la empresa contable auditada

        broadcast(new NotificationBalanceReady(
            $empresaId,
            'El Balance de Sumas y Saldos ha sido consolidado y cerrado por el estudio contable.',
            '/descargas/balances/sumas-y-saldos.pdf'
        ));

        // Retornamos el JSON con los datos del reporte calculado
        return response()->json($reporte);
    }
}

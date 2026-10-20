<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\IvaService;
use App\Services\SueldosService;
use App\Models\AsientoCabecera;

class ProbarContabilidad extends Command
{
    protected $signature = 'contabilidad:test';
    protected $description = 'Simula operaciones de IVA y Sueldos para verificar el Libro Diario';

    public function handle(IvaService $ivaService, SueldosService $sueldosService)
    {
        $this->info("🚀 Iniciando pruebas del motor contable...");

        // 1. Simular una Factura de Venta (IVA)
        // Datos: Neto $100.000 + IVA (21%) $21.000 = Total $121.000
        $this->line("1. Simulando Venta de Factura A-0001...");
        $ivaService->registrarFacturaVenta([
            'fecha' => now()->toDateString(),
            'numero' => 'A-0001',
            'neto_gravado' => 100000.00,
            'monto_iva' => 21000.00,
            'total' => 121000.00
        ]);

        // 2. Simular Liquidación de Sueldos del mes
        // Datos: Bruto $1.500.000, Retenciones $255.000, Neto $1.245.000
        $this->line("2. Simulando Liquidación de Sueldos mensual...");
        $sueldosService->contabilizarLiquidacionMensual('09-2026', [
            'bruto' => 1500000.00,
            'retenciones' => 255000.00,
            'neto_a_pagar' => 1245000.00
        ]);

        $this->info("✅ ¡Asientos generados con éxito!");
        $this->info("Cantidad total de asientos en la BD: " . AsientoCabecera::count());
    }
}

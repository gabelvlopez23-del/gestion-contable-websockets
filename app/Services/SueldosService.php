<?php

namespace App\Services;


use App\Services\ContabilidadService;

class SueldosService
{
    protected $contabilidadService;

    public function __construct(ContabilidadService $contabilidadService)
    {
        $this->contabilidadService = $contabilidadService;
    }

    public function contabilizarLiquidacionMensual(string $periodo, array $totalesNomina)
    {
        // IDs estimados basados en el Seeder
        $idSueldosGasto = 16;   
        $idSueldosAPagar = 8;   
        $idRetencionesAPagar = 9; 

        $lineas = [
            ['plan_cuenta_id' => $idSueldosGasto, 'debe' => $totalesNomina['bruto'], 'haber' => 0],
            ['plan_cuenta_id' => $idSueldosAPagar, 'debe' => 0, 'haber' => $totalesNomina['neto_a_pagar']],
            ['plan_cuenta_id' => $idRetencionesAPagar, 'debe' => 0, 'haber' => $totalesNomina['retenciones']]
        ];

        return $this->contabilidadService->registrarAsiento([
            'fecha' => now()->toDateString(),
            'concepto' => "Liquidación Sueldos Período: $periodo",
            'origen' => 'SUELDOS'
        ], $lineas);
    }
}

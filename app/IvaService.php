<?php

namespace App\Services;

use App\Services\ContabilidadService;

class IvaService
{
    protected $contabilidadService;

    public function __construct(ContabilidadService $contabilidadService)
    {
        $this->contabilidadService = $contabilidadService;
    }

    public function registrarFacturaVenta(array $datosFactura)
    {
        // IDs estimados basados en el Seeder
        $idCuentaDeudores = 5;  
        $idCuentaIvaDebito = 11; 
        $idCuentaVentas = 14;   

        $lineas = [
            ['plan_cuenta_id' => $idCuentaDeudores, 'debe' => $datosFactura['total'], 'haber' => 0],
            ['plan_cuenta_id' => $idCuentaVentas, 'debe' => 0, 'haber' => $datosFactura['neto_gravado']],
            ['plan_cuenta_id' => $idCuentaIvaDebito, 'debe' => 0, 'haber' => $datosFactura['monto_iva']]
        ];

        return $this->contabilidadService->registrarAsiento([
            'fecha' => $datosFactura['fecha'],
            'concepto' => "Venta s/Factura Nro: " . $datosFactura['numero'],
            'origen' => 'IVA_VENTAS'
        ], $lineas);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanCuenta;

class PlanCuentasSeeder extends Seeder
{
    public function run(): void
    {
        $cuentas = [
            // --- ACTIVO ---
            ['codigo' => '1.0.0.00.000', 'nombre' => 'ACTIVO', 'tipo' => 'Activo', 'recibe_asientos' => false],
            ['codigo' => '1.1.0.00.000', 'nombre' => 'ACTIVO CORRIENTE', 'tipo' => 'Activo', 'recibe_asientos' => false],
            ['codigo' => '1.1.1.01.001', 'nombre' => 'Caja Chica', 'tipo' => 'Activo', 'recibe_asientos' => true],
            ['codigo' => '1.1.1.02.001', 'nombre' => 'Banco Nación Cuenta Corriente', 'tipo' => 'Activo', 'recibe_asientos' => true],
            ['codigo' => '1.1.2.01.001', 'nombre' => 'Deudores por Ventas (Clientes)', 'tipo' => 'Activo', 'recibe_asientos' => true],
            
            // --- PASIVO ---
            ['codigo' => '2.0.0.00.000', 'nombre' => 'PASIVO', 'tipo' => 'Pasivo', 'recibe_asientos' => false],
            ['codigo' => '2.1.0.00.000', 'nombre' => 'PASIVO CORRIENTE', 'tipo' => 'Pasivo', 'recibe_asientos' => false],
            ['codigo' => '2.1.1.01.001', 'nombre' => 'Proveedores Locales', 'tipo' => 'Pasivo', 'recibe_asientos' => true],
            ['codigo' => '2.1.2.01.001', 'nombre' => 'Sueldos a Pagar', 'tipo' => 'Pasivo', 'recibe_asientos' => true],
            ['codigo' => '2.1.2.01.002', 'nombre' => 'Retenciones y Cargas Sociales a Pagar', 'tipo' => 'Pasivo', 'recibe_asientos' => true],
            ['codigo' => '2.1.3.01.001', 'nombre' => 'IVA Débito Fiscal', 'tipo' => 'Pasivo', 'recibe_asientos' => true],
            ['codigo' => '2.1.3.01.002', 'nombre' => 'IVA Crédito Fiscal', 'tipo' => 'Activo', 'recibe_asientos' => true], // Nota: Técnicamente es un activo (saldo a favor), pero se agrupa a fines prácticos del módulo IVA

            // --- PATRIMONIO NETO ---
            ['codigo' => '3.0.0.00.000', 'nombre' => 'PATRIMONIO NETO', 'tipo' => 'Patrimonio Neto', 'recibe_asientos' => false],
            ['codigo' => '3.1.1.01.001', 'nombre' => 'Capital Social', 'tipo' => 'Patrimonio Neto', 'recibe_asientos' => true],

            // --- RESULTADOS POSITIVOS (INGRESOS) ---
            ['codigo' => '4.0.0.00.000', 'nombre' => 'RESULTADOS POSITIVOS', 'tipo' => 'Resultado Positivo', 'recibe_asientos' => false],
            ['codigo' => '4.1.1.01.001', 'nombre' => 'Ventas de Mercaderías', 'tipo' => 'Resultado Positivo', 'recibe_asientos' => true],

            // --- RESULTADOS NEGATIVOS (EGRESOS) ---
            ['codigo' => '5.0.0.00.000', 'nombre' => 'RESULTADOS NEGATIVOS', 'tipo' => 'Resultado Negativo', 'recibe_asientos' => false],
            ['codigo' => '5.1.1.01.001', 'nombre' => 'Costo de Mercaderías Vendidas', 'tipo' => 'Resultado Negativo', 'recibe_asientos' => true],
            ['codigo' => '5.1.2.01.001', 'nombre' => 'Sueldos y Jornales (Gastos de Personal)', 'tipo' => 'Resultado Negativo', 'recibe_asientos' => true],
        ];

        foreach ($cuentas as $cuenta) {
            PlanCuenta::updateOrCreate(['codigo' => $cuenta['codigo']], $cuenta);
        }
    }
}

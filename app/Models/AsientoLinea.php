<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsientoLinea extends Model
{
    protected $table = 'asientos_lineas';
    protected $fillable = ['asiento_cabecera_id', 'plan_cuenta_id', 'debe', 'haber'];

    // Cada renglón pertenece a un asiento madre
    public function cabecera()
    {
        return $this->belongsTo(AsientoCabecera::class, 'asiento_cabecera_id');
    }

    // Cada renglón imputa a una cuenta contable específica
    public function cuenta()
    {
        return $this->belongsTo(PlanCuenta::class, 'plan_cuenta_id');
    }
}

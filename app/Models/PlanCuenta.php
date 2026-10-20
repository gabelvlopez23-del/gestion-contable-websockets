<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanCuenta extends Model
{
    protected $table = 'plan_cuentas';
    protected $fillable = ['codigo', 'nombre', 'tipo', 'recibe_asientos'];

    // Una cuenta puede estar imputada en muchos renglones de asientos
    public function lineas()
    {
        return $this->hasMany(AsientoLinea::class, 'plan_cuenta_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsientoCabecera extends Model
{
    protected $table = 'asientos_cabecera';
    protected $fillable = ['fecha', 'concepto', 'origen'];

    // Un asiento principal contiene muchos renglones/líneas
    public function lineas()
    {
        return $this->hasMany(AsientoLinea::class, 'asiento_cabecera_id');
    }
}

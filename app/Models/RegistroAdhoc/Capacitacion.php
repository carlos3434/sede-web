<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    //
    protected $table="capacitaciones";

    public function tipoCapacitacion()
    {
        return $this->belongsTo('App\Models\Settings\TipoCapacitacion', 'tipo_capacitacion_id');
    }

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }

}

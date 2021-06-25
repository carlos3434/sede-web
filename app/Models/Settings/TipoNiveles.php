<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class TipoNiveles extends Model
{
    //
    protected $table="tipo_niveles";

    public function expediente_arhivos()
    {
        return $this->hasMany('App\Models\ExpedienteAdhoc\ExpedienteArchivos','tipo_niveles_id');
    }
}

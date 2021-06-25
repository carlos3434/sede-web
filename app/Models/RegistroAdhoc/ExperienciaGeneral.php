<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;

class ExperienciaGeneral extends Model
{
    //
    protected $table="experiencias_generales";

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }
}

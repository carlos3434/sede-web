<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;

class ExperienciaInspector extends Model
{
    //
    protected $table="experiencias_inspectores";

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }

}

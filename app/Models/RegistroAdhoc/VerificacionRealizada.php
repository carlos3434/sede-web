<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;

class VerificacionRealizada extends Model
{
    //
    protected $table="verificacion_realizadas";

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }
}

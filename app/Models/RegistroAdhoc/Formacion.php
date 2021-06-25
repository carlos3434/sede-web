<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;

class Formacion extends Model
{
    //
    protected $table="formaciones";

    public function grado()
    {
        return $this->belongsTo('App\Models\Settings\Grado', 'grado_id');
    }

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }
}

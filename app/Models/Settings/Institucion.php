<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    //
    protected $table="instituciones";

    /**
     * Obtiene el tipo al que pertenece la institución
     */
    public function tipoDeInstitucion()
    {
        return $this->belongsTo('App\TipoInstitucion', 'tipo_institucion_id');
    }

    public function pais()
    {
        return $this->belongsTo('App\Pais', 'pais_id');
    }
}

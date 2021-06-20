<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    //
    protected $table="paises";

    /**
     * Obtiene los usuarios del Pais
     */
    public function usuarios()
    {
        return $this->hasMany('App\User','pais_id');
    }

    /**
     * Obtiene las instituciones del Pais
     */
    public function instituciones()
    {
        return $this->hasMany('App\Institucion','pais_id');
    }
}

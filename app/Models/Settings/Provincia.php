<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //
    protected $table="provincias";

    public function distritos()
    {
        return $this->hasMany('App\Models\Settings\Distrito','provincia_id');
    }

    /**
     * Obtiene el departamento al que pertenece la provincia
     */
    public function departamento()
    {
        return $this->belongsTo('App\Models\Settings\Departamento', 'departamento_id');
    }

}

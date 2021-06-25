<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table="distritos";
    /**
     * Obtiene los usuarios del Distrito
     */
    public function usuarios()
    {
        return $this->hasMany('App\Models\Auth\User','distrito_id');
    }

    /**
     * Obtiene la provincia a la que pertenece el distrito
     */
    public function provincia()
    {
        return $this->belongsTo('App\Models\Auth\Provincia', 'provincia_id');
    }
}

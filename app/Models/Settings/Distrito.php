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
        return $this->hasMany('App\User','distrito_id');
    }

    /**
     * Obtiene la provincia a la que pertenece el distrito
     */
    public function provincia()
    {
        return $this->belongsTo('App\Provincia', 'provincia_id');
    }
}

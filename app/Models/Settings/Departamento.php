<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table="departamentos";

    protected $hidden = ['created_at','updated_at'];

    /**
     * Obtiene las provincias del Departamento
     */
    public function provincias()
    {
        return $this->hasMany('App\Provincia','departamento_id');
    }

}

<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class TipoInstitucion extends Model
{
    //
    protected $table="tipos_instituciones";

    public function instituciones()
    {
        return $this->hasMany('App\Institucion','tipo_institucion_id');
    }
}

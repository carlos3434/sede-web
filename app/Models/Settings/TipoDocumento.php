<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table="tipos_documentos";

    /**
     * Obtiene los usuarios del TipoDocumento
     */
    public function usuarios()
    {
        return $this->hasMany('App\User','tipo_documento_id');
    }
}

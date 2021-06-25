<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
    //
    protected $table="convocatorias";

    public function items()
    {
        return $this->hasMany('App\Models\SeleccionAdhoc\Item','convocatoria_id');
    }
}

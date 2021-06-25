<?php

namespace App\Models\SeleccionAdhoc;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $table="items";

    public function convocatoria()
    {
        return $this->belongsTo('App\Models\Settings\Convocatoria', 'convocatoria_id');
    }
}

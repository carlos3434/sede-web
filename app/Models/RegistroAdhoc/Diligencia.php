<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Diligencia extends Model
{
    //
    protected $table="diligencias";

    public static function traerDescargaCENEPRED()
    {
        return DB::select('SELECT * FROM diligencias_traer_descargas_cenepred()');
    }

    public function entrega()
    {
        return $this->belongsTo('App\Models\RegistroAdhoc\EntregaExpediente', 'entrega_expediente_id');
    }
}

<?php

namespace App\Models\ExpedienteAdhoc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExpedienteAdhoc extends Model
{
    //
    protected $table = "expedientes_adhocs";

    public static function pendientes()
    {
        return DB::select('select *  from public.expedientes_adhocs_pendientes()');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\Auth\User', 'usuario_id');

    }

    public function usuarioRevisor()
    {
        return $this->belongsTo('App\Models\Auth\User', 'usuario_revisor_id');
    }

    public function observaciones()
    {
        return $this->hasMany('App\Models\ExpedienteAdhoc\Observacion', 'expediente_adhoc_id');
    }

    public function entrega()
    {
        return $this->hasOne('App\Models\RegistroAdhoc\EntregaExpediente', 'expediente_adhoc_id');
    }

    public function estaEntregado()
    {
        $resultado = DB::select('SELECT * FROM entregas_expedientes WHERE expediente_adhoc_id='.$this->id);
        return count($resultado)>0;
    }
}

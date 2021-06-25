<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EntregaExpediente extends Model
{
    //
    protected $table="entregas_expedientes";

    public function expediente()
    {
        return $this->belongsTo('App\Models\ExpedienteAdhoc\ExpedienteAdhoc', 'expediente_adhoc_id');
    }

    //usuario asignador
    public function usuarioAsignador()
    {
        return $this->belongsTo('App\Models\ExpedienteAdhoc\User', 'usuario_asignador_id');
    }

    //acreditacion
    public function acreditacion()
    {
        return $this->belongsTo('App\Models\SeleccionAdhoc\Acreditacion', 'acreditacion_id');
    }



}

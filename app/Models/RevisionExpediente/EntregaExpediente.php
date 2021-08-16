<?php

namespace App\Models\RevisionExpediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Filters\RevisionExpediente\EntregaExpedienteFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class EntregaExpediente extends Model
{
    use LogsActivity;
    //
    protected $table="entregas_expedientes";

    protected $fillable = [
        'fecha_entrega',
        'fecha_recepcion',
        'expediente_adhoc_id',
        'usuario_asignador_id',
        'acreditacion_id',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new EntregaExpedienteFilter($request))->filter($builder);
    }
    public function expediente()
    {
        return $this->belongsTo('App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc', 'expediente_adhoc_id');
    }

    //usuario asignador
    public function usuarioAsignador()
    {
        return $this->belongsTo('App\Models\Auth\User', 'usuario_asignador_id');
    }

    public function diligencia()
    {
        return $this->hasOne('App\Models\DiligenciaVerificador\Diligencia', 'entrega_expediente_id','id');
    }

    //acreditacion
    public function acreditacion()
    {
        return $this->belongsTo('App\Models\SeleccionAdhoc\Acreditacion', 'acreditacion_id');
    }



}

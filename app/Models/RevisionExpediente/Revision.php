<?php

namespace App\Models\RevisionExpediente;

use Illuminate\Database\Eloquent\Model;

use App\Http\Filters\RevisionExpediente\RevisionFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Revision extends Model
{
    use LogsActivity;

    protected $table="revisiones";

    protected $fillable = [
        'observacion',
        'fecha_revision',
        'fecha_subsanacion',
        'estado_revision_id',
        'expedienteadhoc_archivo_id',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new RevisionFilter($request))->filter($builder);
    }
    public function estadoRevision()
    {
        return $this->belongsTo('App\Models\Settings\EstadoRevision', 'estado_revision_id');
    }
    public function expedienteAdhocArchivos()
    {
        return $this->belongsTo('App\Models\RegistroExpedienteAdhoc\ExpedienteAdhocArchivos', 'expedienteadhoc_archivo_id');
    }

}

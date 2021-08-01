<?php

namespace App\Models\RegistroExpedienteAdhoc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Http\Filters\RegistroExpedienteAdhoc\ExpedienteAdhocFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Settings\EstadoExpedienteAdhoc;

class ExpedienteAdhoc extends Model
{
    use LogsActivity;
    //
    protected $table = "expedientes_adhocs";

    protected $fillable = [

        'nombre_comercial',
        'direccion',
        'area',

        'recibo_pago',

        'archivo_solicitud_ht',

        'observaciones',
        'x',
        'y',
        'fecha_solicitud_ht',
        'fecha_ingreso_ht',
        'ht',//numero de hoja tramite

        'numero_operacion',
        'nombre_banco',
        'agencia',
        'fecha_operacion',
        'monto',
        'distrito_id',

        'usuario_id',
        'estado_expediente_id',
        'usuario_revisor_id',

    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ExpedienteAdhocFilter($request))->filter($builder);
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\Auth\User', 'usuario_id');
    }

    public function estadoExpedienteAdhoc()
    {
        return $this->belongsTo('App\Models\Settings\EstadoExpedienteAdhoc', 'estado_expediente_id');
    }

    public function expedienteAdhocArchivos()
    {
        return $this->hasMany('App\Models\RegistroExpedienteAdhoc\ExpedienteAdhocArchivos', 'expedienteadhoc_id');
    }

    /**
     * para tabla pivot 
     */
    public function archivos()
    {
        return $this->belongsToMany(
            'App\Models\RegistroExpedienteAdhoc\Archivo',
            'expedienteadhoc_archivo',
            'expedienteadhoc_id',
            'archivo_id'
        );
    }

    public function usuarioRevisor()
    {
        return $this->belongsTo('App\Models\Auth\User', 'usuario_revisor_id');
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

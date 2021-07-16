<?php

namespace App\Models\RegistroExpedienteAdhoc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Http\Filters\RegistroExpedienteAdhoc\ExpedienteAdhocFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class ExpedienteAdhoc extends Model
{
    use LogsActivity;
    //
    protected $table = "expedientes_adhocs";

    protected $fillable = [

        'nombre_comercial',
        'direccion',
        'area',
        'carta_poder_simple',
        'copia_vigencia_poder',
        'copia_partida_registral',
        'copia_dni_propietario',
        'recibo_pago',
        'copia_formulario_for',
        'informe_tecnico_verificador_responsable',
        'esquela_observacion_sunarp',
        'plano_ubicacion_01',
        'plano_ubicacion_02',
        'plano_arquitectura_1',
        'plano_arquitectura_2',
        'plano_arquitectura_3',
        'plano_arquitectura_4',
        'plano_arquitectura_5',
        'plano_arquitectura_6',
        'plano_arquitectura_7',
        'plano_arquitectura_8',
        'plano_arquitectura_9',
        'plano_arquitectura_10',
        'plano_fabrica_1',
        'plano_fabrica_2',
        'plano_fabrica_3',
        'plano_fabrica_4',
        'plano_fabrica_5',
        'plano_fabrica_6',
        'plano_fabrica_7',
        'plano_fabrica_8',
        'plano_fabrica_9',
        'plano_fabrica_10',
        'plano_remodelacion_1',
        'plano_remodelacion_2',
        'plano_remodelacion_3',
        'plano_remodelacion_4',
        'plano_remodelacion_5',
        'plano_remodelacion_6',
        'plano_remodelacion_7',
        'plano_remodelacion_8',
        'plano_remodelacion_9',
        'plano_remodelacion_10',
        'plano_ampliacion_1',
        'plano_ampliacion_2',
        'plano_ampliacion_3',
        'plano_ampliacion_4',
        'plano_ampliacion_5',
        'plano_ampliacion_6',
        'plano_ampliacion_7',
        'plano_ampliacion_8',
        'plano_ampliacion_9',
        'plano_ampliacion_10',
        'plano_rutas_evacuacion_1',
        'plano_rutas_evacuacion_2',
        'plano_rutas_evacuacion_3',
        'plano_rutas_evacuacion_4',
        'plano_rutas_evacuacion_5',
        'plano_rutas_evacuacion_6',
        'plano_rutas_evacuacion_7',
        'plano_rutas_evacuacion_8',
        'plano_rutas_evacuacion_9',
        'plano_rutas_evacuacion_10',
        'plano_senalizacion_1',
        'plano_senalizacion_2',
        'plano_senalizacion_3',
        'plano_senalizacion_4',
        'plano_senalizacion_5',
        'plano_senalizacion_6',
        'plano_senalizacion_7',
        'plano_senalizacion_8',
        'plano_senalizacion_9',
        'plano_senalizacion_10',
        'memoria_descriptiva_seguridad',
        'certificado_pozo_tierra',
        'certificado_laminados',
        'certificado_sistema_electrico',
        'usuario_id',
        'observaciones',
        'estado_expediente_id',
        'usuario_revisor_id',
        'x',
        'y',
        'fecha_solicitud_ht',
        'fecha_ingreso_ht',
        'ht',
        'usuario_id',
        'usuario_revisor_id',

    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ExpedienteAdhocFilter($request))->filter($builder);
    }


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
        return $this->hasMany('App\Models\RegistroExpedienteAdhoc\Observacion', 'expediente_adhoc_id');
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

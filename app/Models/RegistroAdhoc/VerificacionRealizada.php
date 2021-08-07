<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\RegistroAdhoc\VerificacionRealizadaFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\SeleccionAdhoc\Puntaje;

class VerificacionRealizada extends Model
{
    use LogsActivity;

    protected $table="verificacion_realizadas";

    protected $fillable = [
        'nro_expediente',
        'fecha',
        'nro_informe',
        'usuario_id',
        'institucion_id',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new VerificacionRealizadaFilter($request))->filter($builder);
    }

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }
    public function puntaje( $calificacionId )
    {
        return Puntaje::where('categoria_id',5)
            ->where('calificacion_id',$calificacionId)
            ->first('puntaje');
    }
}

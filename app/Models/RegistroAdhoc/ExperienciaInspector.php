<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\RegistroAdhoc\ExperienciaInspectorFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\SeleccionAdhoc\Puntaje;

class ExperienciaInspector extends Model
{
    use LogsActivity;

    protected $table="experiencias_inspectores";

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'institucion_id',
        'usuario_id',
        'archivo_constancia',
        'archivo_tamano',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ExperienciaInspectorFilter($request))->filter($builder);
    }

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }

    public function puntaje( $calificacionId )
    {
        return Puntaje::where('categoria_id',4)
            ->where('calificacion_id',$calificacionId)
            ->first('puntaje');
    }
}

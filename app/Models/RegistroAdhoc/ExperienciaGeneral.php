<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\RegistroAdhoc\ExperienciaGeneralFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class ExperienciaGeneral extends Model
{
    use LogsActivity;

    protected $table="experiencias_generales";

    protected $fillable = [
        'cargo',
        'fecha_inicio',
        'fecha_fin',
        'tiempo_total',
        'archivo_constancia',
        'archivo_tamano',
        'usuario_id',
        'institucion_id',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ExperienciaGeneralFilter($request))->filter($builder);
    }

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }
}

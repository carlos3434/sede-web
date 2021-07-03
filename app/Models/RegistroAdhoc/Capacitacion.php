<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\RegistroAdhoc\CapacitacionFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Capacitacion extends Model
{
    use LogsActivity;
    protected $table="capacitaciones";

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_termino',
        'horas_lectivas',
        'ciudad',
        'certificado',
        'archivo_tamano',
        'usuario_id',
        'institucion_id',
        'tipo_capacitacion_id',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new CapacitacionFilter($request))->filter($builder);
    }

    public function tipoCapacitacion()
    {
        return $this->belongsTo('App\Models\Settings\TipoCapacitacion', 'tipo_capacitacion_id');
    }

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }

}

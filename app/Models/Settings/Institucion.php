<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Http\Filters\Settings\InstitucionFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Institucion extends Model
{
    const INSTITUCION_ACADEMICA = 1;
    const GOBIERNO_LOCAL = 2;
    const GOBIERNO_DEPARTAMENTAL = 3;

    use LogsActivity;
    //
    protected $table="instituciones";

    protected $fillable = [
        'nombre',
        'etiqueta',
        'tipo_institucion_id',
        'pais_id'
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new InstitucionFilter($request))->filter($builder);
    }

    /**
     * Obtiene el tipo al que pertenece la institución
     */
    public function tipoDeInstitucion()
    {
        return $this->belongsTo('App\Models\Settings\TipoInstitucion', 'tipo_institucion_id');
    }

    public function pais()
    {
        return $this->belongsTo('App\Pais', 'pais_id');
    }
}

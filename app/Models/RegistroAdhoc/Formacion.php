<?php

namespace App\Models\RegistroAdhoc;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\RegistroAdhoc\FormacionFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Formacion extends Model
{
    use LogsActivity;

    protected $table="formaciones";

    protected $fillable = [
        'especialidad',
        'fecha_expedicion',
        'ciudad',
        'archivo_titulo',
        'archivo_tamano',
        'grado_id',
        'institucion_id',
        'usuario_id',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new FormacionFilter($request))->filter($builder);
    }

    public function grado()
    {
        return $this->belongsTo('App\Models\Settings\Grado', 'grado_id');
    }

    public function institucion()
    {
        return $this->belongsTo('App\Models\Settings\Institucion', 'institucion_id');
    }
}

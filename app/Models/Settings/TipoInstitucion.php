<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Http\Filters\Settings\TipoInstitucionFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class TipoInstitucion extends Model
{
    use LogsActivity;
    //
    protected $table="tipos_instituciones";

    public function scopeFilter(Builder $builder, $request)
    {
        return (new TipoInstitucionFilter($request))->filter($builder);
    }

    protected $fillable = [
        'nombre'
    ];

    public function instituciones()
    {
        return $this->hasMany('App\Models\Settings\Institucion','tipo_institucion_id');
    }
}

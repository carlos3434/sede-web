<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Http\Filters\Settings\ConvocatoriaFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Convocatoria extends Model
{
    use LogsActivity;
    //
    protected $table="convocatorias";

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_final'
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ConvocatoriaFilter($request))->filter($builder);
    }

    public function items()
    {
        return $this->hasMany('App\Models\SeleccionAdhoc\Item','convocatoria_id');
    }
}

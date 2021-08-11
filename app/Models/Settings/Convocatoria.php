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
        'activo',
        'fecha_final'
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new ConvocatoriaFilter($request))->filter($builder);
    }

    public function scopeGetActual()
    {
        return $this->where('activo',1)
        //->where('fecha_inicio', '<=', date("Y-m-d") )
        //->where('fecha_final', '>=', date("Y-m-d") )
        ->select('id','nombre','fecha_inicio','fecha_final')
        ->first();
    }
}

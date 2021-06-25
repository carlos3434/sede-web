<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\Settings\ConfiguracionFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Configuracion extends Model
{

    use LogsActivity;
    //
    protected $table="configuraciones";
    protected $fillable = [
        'nombre',
        'valor'
    ];
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ConfiguracionFilter($request))->filter($builder);
    }

    public static function convocatoriaActual()
    {
        $convocatoria = \App\Models\Settings\Configuracion::where('nombre', 'CONVOCATORIA_ACTUAL')->take(1)->get();
        return isset( $convocatoria[0] ) ? $convocatoria[0]->valor  : false;
    }
}

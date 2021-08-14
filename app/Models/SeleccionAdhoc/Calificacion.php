<?php

namespace App\Models\SeleccionAdhoc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\SeleccionAdhoc\Acreditacion;
use App\Http\Filters\SeleccionAdhoc\CalificacionFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Calificacion extends Model
{
    use LogsActivity;
    //
    protected $table="calificaciones";

    protected $fillable = [
        'usuario_id',
        'convocatoria_id',
        'sede_registral_id',
        'fecha',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new CalificacionFilter($request))->filter($builder);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User', 'usuario_id');
    }

    public function convocatoria()
    {
        return $this->belongsTo('App\Models\Settings\Convocatoria', 'convocatoria_id');
    }

    public function sedeRegistral()
    {
        return $this->belongsTo('App\Models\Settings\SedeRegistral', 'sede_registral_id');
    }

    public function puntajes()
    {
        return $this->hasMany('App\Models\SeleccionAdhoc\Puntaje','calificacion_id');
    }
    /**
     * determina si una calificacion esta acreditada
     */
    public function scopeEstaAcreditado()
    {
        return (bool) Acreditacion::where('calificacion_id',$this->id)->count();
    }

    public function scopePuntajeToTal()
    {
        $total = 0;
        foreach ($this->puntajes as $puntaje)
        {
            $total = $total + $puntaje->puntaje;
        }
        return $total;
    }

    public function puntajeTotal()
    {
        $total = 0;

        foreach ($this->puntajes as $puntaje)
        {
            $total = $total + $puntaje->puntaje;
        }

        return $total;
    }

    public function acreditacion()
    {
        return $this->hasOne('App\Models\SeleccionAdhoc\Acreditacion','calificacion_id');
    }

}

<?php

namespace App\Models\SeleccionAdhoc;

use Illuminate\Database\Eloquent\Model;

use App\Http\Filters\Settings\PuntajeFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Puntaje extends Model
{
    use LogsActivity;
    //
    protected $table="puntajes";

    protected $fillable = [
        'calificacion_id',
        'item_id',
        'puntaje'
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new PuntajeFilter($request))->filter($builder);
    }

    public function item(){
        return $this->belongsTo('App\Models\SeleccionAdhoc\Item', 'item_id');
    }

    public function calificacion(){
        return $this->belongsTo('App\Models\SeleccionAdhoc\Calificacion', 'calificacion_id');
    }

}

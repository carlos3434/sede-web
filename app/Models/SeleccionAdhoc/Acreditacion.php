<?php

namespace App\Models\SeleccionAdhoc;

use Illuminate\Database\Eloquent\Model;
//use App\Calificacion;
//use App\User;
//use Illuminate\Support\Facades\DB;
use App\Http\Filters\SeleccionAdhoc\AcreditacionFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class Acreditacion extends Model
{
    use LogsActivity;
    //
    protected $table="acreditaciones";

    protected $fillable = [
        'calificacion_id',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new AcreditacionFilter($request))->filter($builder);
    }
    public function calificacion()
    {
        return $this->belongsTo('App\Models\SeleccionAdhoc\Calificacion','calificacion_id');
    }

    public static function traerTodos()
    {
        //return DB::select('SELECT * FROM acreditaciones_todos()');
    }

}

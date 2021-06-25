<?php

namespace App\Models\SeleccionAdhoc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Calificacion extends Model
{
    //
    protected $table="calificaciones";

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

    public static function resultados($p_convocatoria_id,$p_sede_registral_id)
    {
        return DB::select('select * from calificaciones_resultados('.$p_convocatoria_id.','.$p_sede_registral_id.')');
    }

    public static function pendientes($p_convocatoria_id)
    {
        return DB::select('select * from calificaciones_pendientes('.$p_convocatoria_id.')');
    }



}

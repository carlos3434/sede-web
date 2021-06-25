<?php

namespace App\Models\SeleccionAdhoc;

use Illuminate\Database\Eloquent\Model;
use App\Calificacion;
use App\User;
use Illuminate\Support\Facades\DB;

class Acreditacion extends Model
{
    //
    protected $table="acreditaciones";

    public function calificacion()
    {
        return $this->belongsTo('App\Models\SeleccionAdhoc\Calificacion','calificacion_id');
    }

    public static function traerTodos()
    {
        return DB::select('SELECT * FROM acreditaciones_todos()');
    }

}

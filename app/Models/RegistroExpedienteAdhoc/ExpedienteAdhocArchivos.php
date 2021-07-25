<?php

namespace App\Models\RegistroExpedienteAdhoc;

use Illuminate\Database\Eloquent\Model;

class ExpedienteAdhocArchivos extends Model
{
    protected $table="expedienteadhoc_archivo";

    protected $fillable = [
        'archivo_id',
        'valor',
        'expedienteadhoc_id'
    ];

    public function archivo()
    {
        return $this->belongsTo('App\Models\RegistroExpedienteAdhoc\Archivo', 'archivo_id');
    }

    public function expedienteAdhoc()
    {
        return $this->belongsTo('App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc', 'expedienteadhoc_id');
    }
    /*
    public function scopeArchivos($query)
    {
        return $query->leftjoin('expedienteadhoc_archivo as ea', 'expedientes_adhocs.id', '=', 'ea.expedienteadhoc_id')
                     ->rightJoin('archivos as a','ea.archivo_id','=','a.id');
    }*/
}

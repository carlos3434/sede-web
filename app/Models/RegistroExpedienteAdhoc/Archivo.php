<?php

namespace App\Models\RegistroExpedienteAdhoc;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table="archivos";

    protected $fillable = [
        'nombre',
        'slug',
        'convocatoria_id',
        'level',
        'parent_id',
    ];

    public function convocatoria()
    {
        return $this->belongsTo('App\Models\Settings\Convocatoria', 'convocatoria_id');
    }

    public function archivoCategoria()
    {
        return $this->belongsTo('App\Models\RegistroExpedienteAdhoc\Archivo','parent_id');
    }

    public function hijos()
    {
        return $this->hasMany('App\Models\RegistroExpedienteAdhoc\Archivo','parent_id','id');
    }
    /**
     * para tabla pivot 
     */
    public function expedienteAdhoc()
    {
        return $this->belongsToMany(
            'App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc',
            'expedienteadhoc_archivo',
            'expedienteadhoc_id',
            'archivo_id'
        );
    }


/*
    public function scopeGetPadres($query)
    {
         return $query->where('level',1);
    }
    public function scopeGetChild($query)
    {
        return $query->get();
    }*/
    public function scopeGetArchivosByConvocatoriaId( $query , $convocatoriaId )
    {
        return $this->where('convocatoria_id', $convocatoriaId )
        ->where('level',2)//level 2
        ->select('id as archivo_id')
        ->get();
    }
    public function scopeGetArchivosCategoriaByConvocatoriaId( $query , $convocatoriaId )
    {
        return $this->where('convocatoria_id', $convocatoriaId )
        ->where('level',1)//level 2
        ->select('id','nombre','slug')
        ->get();
    }
}

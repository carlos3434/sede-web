<?php

namespace App\Models\RegistroExpedienteAdhoc;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table="archivos";

    protected $fillable = [
        'nombre',
        'slug',
        'level',
        'activo',
        'parent_id',
    ];

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
    /**
     * para tabla pivot 
     */
    public function expedienteadhoc_archivo()
    {
        return $this->hasMany('App\Models\RegistroExpedienteAdhoc\ExpedienteAdhocArchivos', 'archivo_id','id');
    }

    public function scopeGetArchivosParent( $query )
    {
        return $this->where('level',2)//level 2
        ->where('activo',1)
        ->select('id as archivo_id')
        ->get();
    }
}

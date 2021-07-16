<?php

namespace App\Models\RegistroExpedienteAdhoc;

use Illuminate\Database\Eloquent\Model;

class ExpedienteArchivos extends Model
{
    protected $table="expediente_archivos";

    public function tipoDeNiveles()
    {
        return $this->belongsTo('App\Models\Settings\TipoNiveles', 'tipo_niveles_id');
    }
}

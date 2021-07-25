<?php

namespace App\Models\RegistroExpedienteAdhoc;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    //
    protected $table="observaciones";

    protected $fillable = [
        'descripcion',
        'fecha',
        'estado_observacion_id',
        'expedienteadhoc_archivo_id',
    ];

}

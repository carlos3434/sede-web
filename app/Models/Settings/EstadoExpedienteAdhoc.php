<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class EstadoExpedienteAdhoc extends Model
{
    const CREADO = 1;
    const HOJATRAMITE = 2;
    const SOLICITUDVERIFICACION = 3;
    const OBSERVADO = 4;//observado en revision de expediente
    const ENTREGADO = 5;
    const RECIBIDO = 6;
    const PROGRAMADO = 7;//cuando se programa diligencia

    protected $table="estado_expediente";
}

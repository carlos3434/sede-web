<?php
namespace App\Http\Filters\RegistroExpedienteAdhoc;


use App\Http\Filters\AbstractFilter;
use App\Http\Filters\Commons\UsuarioFilter;
use App\Http\Filters\Commons\FechaFilter;
use App\Http\Filters\Commons\ConvocatoriaFilter;
use App\Http\Filters\Commons\SedeRegistralFilter;
use App\Http\Filters\Commons\EstadosExpedienteFilter;
use App\Http\Filters\RegistroExpedienteAdhoc\ExpedienteAdhoc\NombreComercialFilter;
use App\Http\Filters\RegistroExpedienteAdhoc\Calificacion\FiltroFilter;

class ExpedienteAdhocFilter extends AbstractFilter
{
    protected $filters = [
        'usuario_id'        => UsuarioFilter::class,
        'convocatoria_id'   => ConvocatoriaFilter::class,
        'nombre_comercial'  => NombreComercialFilter::class,
        'sede_registral_id' => SedeRegistralFilter::class,
        'estado_expediente_id'=> EstadosExpedienteFilter::class,
        'fecha'             => FechaFilter::class,

    ];
}
<?php
namespace App\Http\Filters\DiligenciaVerificador;


use App\Http\Filters\AbstractFilter;

use App\Http\Filters\DiligenciaVerificador\Diligencia\UsuarioAdhocFilter;
use App\Http\Filters\DiligenciaVerificador\Diligencia\UsuarioAdministradoFilter;
use App\Http\Filters\Commons\EstadosExpedienteFilter;
use App\Http\Filters\RegistroExpedienteAdhoc\ExpedienteAdhoc\NombreComercialFilter;

class DiligenciaFilter extends AbstractFilter
{

    protected $filters = [
        'estado_expediente_id'       => EstadosExpedienteFilter::class,
        'nombre_comercial'           => NombreComercialFilter::class,
        'verificador_id'             => UsuarioAdhocFilter::class,
        'administrado_id'            => UsuarioAdministradoFilter::class,
    ];
}
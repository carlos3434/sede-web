<?php
namespace App\Http\Filters\RegistroAdhoc;


use App\Http\Filters\AbstractFilter;

use App\Http\Filters\Commons\InstitucionFilter;
use App\Http\Filters\Commons\UsuarioFilter;

class VerificacionRealizadaFilter extends AbstractFilter
{
    protected $filters = [
        'fecha' => VerificacionRealizada\FechaFilter::class,
        'institucion_id' => InstitucionFilter::class,
        'usuario_id' => UsuarioFilter::class

    ];
}
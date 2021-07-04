<?php
namespace App\Http\Filters\SeleccionAdhoc;


use App\Http\Filters\AbstractFilter;
use App\Http\Filters\Commons\UsuarioFilter;
use App\Http\Filters\Commons\FechaFilter;
use App\Http\Filters\Commons\ConvocatoriaFilter;
use App\Http\Filters\Commons\SedeRegistralFilter;

class CalificacionFilter extends AbstractFilter
{
    protected $filters = [
        'usuario_id'        => UsuarioFilter::class,
        'convocatoria_id'   => ConvocatoriaFilter::class,
        'sede_registral_id' => SedeRegistralFilter::class,
        'fecha'             => FechaFilter::class,

    ];
}
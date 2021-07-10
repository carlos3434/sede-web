<?php
namespace App\Http\Filters\SeleccionAdhoc;


use App\Http\Filters\AbstractFilter;
use App\Http\Filters\Commons\UsuarioFilter;
use App\Http\Filters\Commons\FechaFilter;
use App\Http\Filters\Commons\ConvocatoriaFilter;
use App\Http\Filters\Commons\SedeRegistralFilter;
use App\Http\Filters\SeleccionAdhoc\Calificacion\FiltroFilter;

class CalificacionFilter extends AbstractFilter
{
    protected $filters = [
        //'puntaje'           => UsuarioFilter::class,
        'filtro'            => FiltroFilter::class,
        'usuario_id'        => UsuarioFilter::class,
        'convocatoria_id'   => ConvocatoriaFilter::class,
        'sede_registral_id' => SedeRegistralFilter::class,
        'fecha'             => FechaFilter::class,

    ];
}
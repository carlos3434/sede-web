<?php
namespace App\Http\Filters\SeleccionAdhoc;


use App\Http\Filters\AbstractFilter;
use App\Http\Filters\Puntaje\PuntajeNumberFilter;
use App\Http\Filters\Puntaje\ItemFilter;
use App\Http\Filters\Puntaje\CalificacionFilter;

class PuntajeFilter extends AbstractFilter
{
    protected $filters = [
        'puntaje'         => PuntajeNumberFilter::class,
        'item_id'         => ItemFilter::class,
        'calificacion_id' => CalificacionFilter::class,

    ];
}
<?php
namespace App\Http\Filters\Settings;


use App\Http\Filters\AbstractFilter;
use App\Http\Filters\Commons\ActivoFilter;
use App\Http\Filters\Commons\NombreFilter;

class ConvocatoriaFilter extends AbstractFilter
{
    protected $filters = [
        'activo' => ActivoFilter::class,
        'nombre' => NombreFilter::class,
        'fecha_inicio' => Convocatoria\FechaInicioFilter::class,
        'fecha_final' => Convocatoria\FechaFinalFilter::class
    ];
}
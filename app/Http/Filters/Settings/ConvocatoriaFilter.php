<?php
namespace App\Http\Filters\Settings;


use App\Http\Filters\AbstractFilter;

class ConvocatoriaFilter extends AbstractFilter
{
    protected $filters = [
        'nombre' => Common\NombreFilter::class,
        'fecha_inicio' => Convocatoria\FechaInicioFilter::class,
        'fecha_final' => Convocatoria\FechaFinalFilter::class
    ];
}
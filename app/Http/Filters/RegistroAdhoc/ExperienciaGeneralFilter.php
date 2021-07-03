<?php
namespace App\Http\Filters\RegistroAdhoc;


use App\Http\Filters\AbstractFilter;

use App\Http\Filters\Commons\InstitucionFilter;
use App\Http\Filters\Commons\UsuarioFilter;
use App\Http\Filters\Commons\FechaInicioFilter;
use App\Http\Filters\Commons\FechaFinFilter;

class ExperienciaGeneralFilter extends AbstractFilter
{
    protected $filters = [
        'fecha_inicio' => FechaInicioFilter::class,
        'fecha_fin' => FechaFinFilter::class,
        'institucion_id' => InstitucionFilter::class,
        'usuario_id' => UsuarioFilter::class
    ];
}
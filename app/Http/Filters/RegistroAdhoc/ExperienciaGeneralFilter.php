<?php
namespace App\Http\Filters\RegistroAdhoc;


use App\Http\Filters\AbstractFilter;
use App\Http\Filters\Commons\GradoFilter;
use App\Http\Filters\Commons\InstitucionFilter;
use App\Http\Filters\Commons\UsuarioFilter;

class ExperienciaGeneralFilter extends AbstractFilter
{
    protected $filters = [
        'fecha_expedicion' => ExperienciaGeneral\FechaExpedicionFilter::class,
        'grado_id' => GradoFilter::class,
        'institucion_id' => InstitucionFilter::class,
        'usuario_id' => UsuarioFilter::class
    ];
}
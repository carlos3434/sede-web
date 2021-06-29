<?php
namespace App\Http\Filters\RegistroAdhoc;


use App\Http\Filters\AbstractFilter;
use App\Http\Filters\Commons\GradoFilter;
use App\Http\Filters\Commons\InstitucionFilter;
use App\Http\Filters\Commons\UsuarioFilter;

class FormacionFilter extends AbstractFilter
{
    protected $filters = [
        'fecha_expedicion' => Formacion\FechaExpedicionFilter::class,
        'grado_id' => GradoFilter::class,
        'institucion_id' => InstitucionFilter::class,
        'usuario_id' => UsuarioFilter::class
    ];
}
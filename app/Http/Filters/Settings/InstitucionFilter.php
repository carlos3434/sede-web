<?php
namespace App\Http\Filters\Settings;


use App\Http\Filters\AbstractFilter;

class InstitucionFilter extends AbstractFilter
{
    protected $filters = [
        'nombre' => Common\NombreFilter::class,
        'etiqueta' => Institucion\EtiquetaFilter::class,
        'tipo_institucion_id' => Institucion\TipoInstitucionFilter::class,
        'pais_id' => Institucion\PaisFilter::class,
    ];
}
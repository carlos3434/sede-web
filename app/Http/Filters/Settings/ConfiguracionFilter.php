<?php
namespace App\Http\Filters\Settings;


use App\Http\Filters\AbstractFilter;

class ConfiguracionFilter extends AbstractFilter
{
    protected $filters = [
        'nombre' => Configuracion\NombreFilter::class,
        'valor' => Configuracion\ValorFilter::class,
    ];
}
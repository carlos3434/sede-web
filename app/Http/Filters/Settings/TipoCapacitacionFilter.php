<?php
namespace App\Http\Filters\Settings;


use App\Http\Filters\AbstractFilter;

class TipoCapacitacionFilter extends AbstractFilter
{
    protected $filters = [
        'nombre' => Common\NombreFilter::class
    ];
}
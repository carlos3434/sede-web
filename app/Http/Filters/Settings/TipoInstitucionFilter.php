<?php
namespace App\Http\Filters\Settings;


use App\Http\Filters\AbstractFilter;

class TipoInstitucionFilter extends AbstractFilter
{
    protected $filters = [
        'nombre' => Common\NombreFilter::class
    ];
}
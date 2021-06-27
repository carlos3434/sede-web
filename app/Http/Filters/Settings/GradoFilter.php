<?php
namespace App\Http\Filters\Settings;


use App\Http\Filters\AbstractFilter;

class GradoFilter extends AbstractFilter
{
    protected $filters = [
        'nombre' => Common\NombreFilter::class
    ];
}
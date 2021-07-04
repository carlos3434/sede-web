<?php
namespace App\Http\Filters\RegistroAdhoc;


use App\Http\Filters\AbstractFilter;
use App\Http\Filters\Commons\NombreFilter;

class SedeRegistralFilter extends AbstractFilter
{
    protected $filters = [
        'nombre' => NombreFilter::class,
    ];
}
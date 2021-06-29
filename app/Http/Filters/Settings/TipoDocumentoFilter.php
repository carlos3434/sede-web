<?php
namespace App\Http\Filters\Settings;


use App\Http\Filters\AbstractFilter;
use App\Http\Filters\Commons\NombreFilter;

class TipoDocumentoFilter extends AbstractFilter
{
    protected $filters = [
        'nombre' => NombreFilter::class
    ];
}
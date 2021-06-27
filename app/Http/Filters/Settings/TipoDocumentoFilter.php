<?php
namespace App\Http\Filters\Settings;


use App\Http\Filters\AbstractFilter;

class TipoDocumentoFilter extends AbstractFilter
{
    protected $filters = [
        'nombre' => Common\NombreFilter::class
    ];
}
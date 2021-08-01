<?php
namespace App\Http\Filters\DiligenciaVerificador;


use App\Http\Filters\AbstractFilter;

use App\Http\Filters\DiligenciaVerificador\Diligencia\UsuarioAdhocFilter;

class DiligenciaFilter extends AbstractFilter
{

    protected $filters = [
        'verificador_id'             => UsuarioAdhocFilter::class,
    ];
}
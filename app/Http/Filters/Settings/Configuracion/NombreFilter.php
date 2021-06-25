<?php
namespace App\Http\Filters\Settings\Configuracion;

class NombreFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('nombre', $value);
    }
}
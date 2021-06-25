<?php
namespace App\Http\Filters\Settings\Configuracion;

class ValorFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('valor', $value);
    }
}
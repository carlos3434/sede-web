<?php
namespace App\Http\Filters\Settings\Institucion;

class PaisFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('pais_id', $value);
    }
}
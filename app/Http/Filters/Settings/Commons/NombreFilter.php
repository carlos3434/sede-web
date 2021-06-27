<?php
namespace App\Http\Filters\Settings\Commons;

class NombreFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('nombre', $value);
    }
}
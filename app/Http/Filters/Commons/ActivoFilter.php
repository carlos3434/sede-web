<?php
namespace App\Http\Filters\Commons;

class ActivoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('activo', $value);
    }
}
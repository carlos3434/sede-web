<?php
namespace App\Http\Filters\Commons;

class InstitucionFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('institucion_id', $value);
    }
}
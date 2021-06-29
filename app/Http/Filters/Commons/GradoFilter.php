<?php
namespace App\Http\Filters\Commons;

class GradoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('grado_id', $value);
    }
}
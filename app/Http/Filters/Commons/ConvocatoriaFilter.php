<?php
namespace App\Http\Filters\Commons;

class ConvocatoriaFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('convocatoria_id', $value);
    }
}
<?php
namespace App\Http\Filters\Commons;

class SedeRegistralFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('sede_registral_id', $value);
    }
}
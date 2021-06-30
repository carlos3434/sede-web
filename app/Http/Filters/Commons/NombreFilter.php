<?php
namespace App\Http\Filters\Commons;

class NombreFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('nombre', 'like', '%'.$value.'%');
    }
}
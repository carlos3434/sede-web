<?php
namespace App\Http\Filters\Puntaje;

class ItemFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('item_id', $value);
    }
}
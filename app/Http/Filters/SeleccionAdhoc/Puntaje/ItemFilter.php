<?php
namespace App\Http\Filters\SeleccionAdhoc\Puntaje;

class ItemFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('item_id', $value);
    }
}
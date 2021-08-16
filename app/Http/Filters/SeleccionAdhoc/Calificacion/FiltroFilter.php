<?php
namespace App\Http\Filters\SeleccionAdhoc\Calificacion;

class FiltroFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('filtro', $value);
    }
}
<?php
namespace App\Http\Filters\SeleccionAdhoc\Puntaje;

class CalificacionFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('calificacion_id', $value);
    }
}
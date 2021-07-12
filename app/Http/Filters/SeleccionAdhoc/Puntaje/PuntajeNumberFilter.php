<?php
namespace App\Http\Filters\SeleccionAdhoc\Puntaje;

class PuntajeNumberFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('puntaje', $value);
    }
}
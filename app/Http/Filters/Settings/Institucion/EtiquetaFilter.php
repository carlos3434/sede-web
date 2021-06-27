<?php
namespace App\Http\Filters\Settings\Institucion;

class EtiquetaFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('etiqueta', $value);
    }
}
<?php
namespace App\Http\Filters\Settings\Institucion;

class TipoInstitucionFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('tipo_institucion_id', $value);
    }
}
<?php
namespace App\Http\Filters\Commons;

class UsuarioFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('usuario_id', $value);
    }
}
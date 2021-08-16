<?php
namespace App\Http\Filters\DiligenciaVerificador\Diligencia;

class UsuarioAdhocFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('c.usuario_id', $value);
    }
}
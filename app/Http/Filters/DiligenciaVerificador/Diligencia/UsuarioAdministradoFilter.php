<?php
namespace App\Http\Filters\DiligenciaVerificador\Diligencia;

class UsuarioAdministradoFilter
{
    public function filter($builder, $value)
    {
        //expedientes_adhocs as ea
        return $builder->where('ea.usuario_id', $value);
    }
}
<?php
namespace App\Http\Filters\RevisionExpediente\EntregaExpediente;

class UsuarioAsignadorFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha) {
                    if (validateDate($fecha)) {
                        $builder->orWhere('usuario_asignador_id', date("Y-m-d", strtotime($fecha)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('usuario_asignador_id', $value);
        }
        return $builder;
    }
}
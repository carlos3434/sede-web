<?php
namespace App\Http\Filters\RevisionExpediente\EntregaExpediente;

class AcreditacionFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('acreditacion_id', $value);
    }
}
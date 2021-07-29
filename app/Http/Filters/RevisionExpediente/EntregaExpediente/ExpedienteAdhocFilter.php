<?php
namespace App\Http\Filters\RevisionExpediente\EntregaExpediente;

class ExpedienteAdhocFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('expedienteadhoc_id', $value);
    }
}
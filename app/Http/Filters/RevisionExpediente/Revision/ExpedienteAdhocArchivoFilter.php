<?php
namespace App\Http\Filters\RevisionExpediente\Revision;

class ExpedienteAdhocArchivoFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('expedienteadhoc_archivo_id', $value);
    }
}
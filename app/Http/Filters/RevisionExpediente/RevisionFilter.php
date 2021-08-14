<?php
namespace App\Http\Filters\RevisionExpediente;


use App\Http\Filters\AbstractFilter;

use App\Http\Filters\RevisionExpediente\Revision\FechaRevisionFilter;
use App\Http\Filters\RevisionExpediente\Revision\FechaSubsanacionFilter;
use App\Http\Filters\RevisionExpediente\Revision\ExpedienteAdhocArchivoFilter;
use App\Http\Filters\Commons\EstadosRevisionFilter;

class RevisionFilter extends AbstractFilter
{
    protected $filters = [
        'fecha_revision'              => FechaRevisionFilter::class,
        'fecha_subsanacion'           => FechaSubsanacionFilter::class,
        'estado_revision_id'          => EstadosRevisionFilter::class,
        'expedienteadhoc_archivo_id'  => ExpedienteAdhocArchivoFilter::class,
    ];
}
<?php
namespace App\Http\Filters\RevisionExpediente;

use App\Http\Filters\AbstractFilter;
use App\Http\Filters\RevisionExpediente\EntregaExpediente\FechaEntregaFilter;
use App\Http\Filters\RevisionExpediente\EntregaExpediente\FechaRecepcionFilter;
use App\Http\Filters\RevisionExpediente\EntregaExpediente\ExpedienteAdhocFilter;
use App\Http\Filters\RevisionExpediente\EntregaExpediente\UsuarioAsignadorFilter;
use App\Http\Filters\RevisionExpediente\EntregaExpediente\AcreditacionFilter;

class EntregaExpedienteFilter extends AbstractFilter
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        dd($this->request);
    }
    protected $filters = [
        'fecha_entrega'        => FechaEntregaFilter::class,
        'fecha_recepcion'      => FechaRecepcionFilter::class,
        'expediente_adhoc_id'  => ExpedienteAdhocFilter::class,
        'usuario_asignador_id' => UsuarioAsignadorFilter::class,
        'acreditacion_id'      => AcreditacionFilter::class,
    ];
}
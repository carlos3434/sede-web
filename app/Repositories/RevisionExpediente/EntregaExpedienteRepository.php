<?php
namespace App\Repositories\RevisionExpediente;

use App\Repositories\AbstractRepository;
/*
use App\Repositories\RevisionExpediente\Interfaces\EntregaExpedienteRepositoryInterface;
use App\Http\Resources\RevisionExpediente\EntregaExpediente\EntregaExpedienteExcelCollection;
use App\Http\Resources\RevisionExpediente\EntregaExpediente\EntregaExpedienteCollection;
use App\Models\RevisionExpediente\EntregaExpediente;
*/

use App\Repositories\RevisionExpediente\Interfaces\EntregaExpedienteRepositoryInterface;
use App\Models\RevisionExpediente\EntregaExpediente;
use App\Http\Requests\RevisionExpediente\EntregaExpedienteRequest;
use App\Http\Requests\RegistroExpedienteAdhoc\ExpedienteAdhocAddRequest;
/**
 * 
 */
class EntregaExpedienteRepository extends AbstractRepository implements EntregaExpedienteRepositoryInterface
{

    protected $modelClassName = 'EntregaExpediente';
    protected $modelClassNamePath = "App\Models\RevisionExpediente\EntregaExpediente";
    protected $collectionNamePath = "App\Http\Resources\RevisionExpediente\EntregaExpediente\EntregaExpedienteCollection";
    protected $resourceNamePath = "App\Http\Resources\RevisionExpediente\EntregaExpediente\EntregaExpedienteResource";

    public function allToExport($request)
    {
        return new EntregaExpedienteExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }
    public function expedientes()
    {
        return \DB::table('expedientes_adhocs as ea')
        ->join('estado_expediente as ee', 'ea.estado_expediente_id', '=', 'ee.id')
        ->join('users as u', 'ea.usuario_id', '=', 'u.id')
        ->leftJoin('entregas_expedientes as eee', 'ea.id', '=', 'eee.expediente_adhoc_id')
        ->leftJoin('acreditaciones as a', 'eee.acreditacion_id', '=', 'a.id')
        ->leftJoin('calificaciones as c', 'a.calificacion_id', '=', 'c.id')
        ->leftJoin('users as adhoc', 'c.usuario_id', '=', 'adhoc.id')
        ->leftJoin('users as cenepred', 'eee.usuario_asignador_id', '=', 'cenepred.id')
        ->select(
            'ea.id' , 'ea.nombre_comercial' , 'ea.direccion',
            'ee.nombre as estado_expediente', 'ee.id as estado_id',
            'eee.fecha_entrega',
            'u.nombres as administrado_nombres',
            'u.apellido_paterno as administrado_apellido_paterno',
            'u.apellido_materno as administrado_apellido_paterno',
            'u.id as administrado_id',
            'adhoc.nombres AS adhoc_nombres',
            'adhoc.apellido_paterno as adhoc_apellido_paterno',
            'adhoc.apellido_materno as adhoc_apellido_materno',
            'adhoc.id as adhoc_id',
            'cenepred.nombres as cenepred_nombres',
            'cenepred.apellido_paterno as cenepred_apellido_paterno',
            'cenepred.apellido_materno as cenepred_apellido_materno',
            'cenepred.id as cenepred_id'
        )
        ->paginate();
    }
}
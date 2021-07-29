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

    public function getByConvocatoriaAndExpediente($convocatoriaId , $expedienteAdhocId ){
        return \DB::select("
            SELECT eaa.id, eaa.nombre_comercial , eaa.direccion , eaa.area,
                   eaa.monto , eaa.nombre_banco , eaa.numero_operacion  ,
                   eaa.fecha_operacion , eaa.agencia ,  eaa.distrito_id ,
                   eaa.recibo_pago, eaa.archivo_solicitud_ht,

                   ee.id as estado_expediente_id, ee.nombre as estado_expediente_nombre,

                   ea.id AS expedienteadhoc_archivo_id, ea.valor AS valor_archivo,
                   a.id AS archivo_id, a.nombre AS nombre_archivo, a.slug AS slug_archivo,
                   padre.id id_padre, padre.nombre AS nombre_padre , padre.slug AS slug_padre,

                   adhoc.nombres AS adhoc_nombres,
                   adhoc.apellido_paterno as adhoc_apellido_paterno,
                   adhoc.apellido_materno as adhoc_apellido_materno,
                   adhoc.id as adhoc_id,

                   r.id as revision_id,
                   ea.id AS expedienteadhoc_archivo_id,
                   er.id as estado_revision_id,
                   er.nombre as estado_revision_nombre,

                   ( SELECT count(id) AS total 
                       FROM archivos 
                       WHERE convocatoria_id = ? and level = 2 
                    )   AS total,
                   ( SELECT count(id) AS completados 
                       FROM expedienteadhoc_archivo 
                       WHERE expedienteadhoc_id = ? 
                    )   AS completados
                   
            FROM expedientes_adhocs AS eaa 
            JOIN estado_expediente AS ee on eaa.estado_expediente_id = ee.id
            LEFT JOIN expedienteadhoc_archivo AS ea on eaa.id = ea.expedienteadhoc_id

            LEFT JOIN revisiones AS r ON ea.id = r.expedienteadhoc_archivo_id
            LEFT JOIN estado_revision AS er ON r.estado_revision_id = er.id

            RIGHT JOIN archivos AS a on ea.archivo_id = a.id
            JOIN archivos AS padre on a.parent_id = padre.id 
            LEFT JOIN entregas_expedientes AS eee ON ea.id = eee.expediente_adhoc_id
            LEFT JOIN acreditaciones AS aa ON eee.acreditacion_id = aa.id
            LEFT JOIN calificaciones AS c ON aa.calificacion_id = c.id
            LEFT JOIN users AS adhoc ON c.usuario_id = adhoc.id

            WHERE eaa.id = ? and a.convocatoria_id = ?

            GROUP BY eaa.id , ea.id , a.id, padre.id , ee.id, adhoc.id, r.id, er.id
            ORDER BY padre.id;",
            [$convocatoriaId,$expedienteAdhocId,$expedienteAdhocId,$convocatoriaId]
        );
    }
    public function getRevisiones($expedienteAdhocId)
    {
        return \DB::table('expedienteadhoc_archivo as ea')
        ->select('r.estado_revision_id','er.nombre AS estado_revision',\DB::raw('count( r.id ) AS total'))
        ->join('revisiones as r', 'ea.id', '=', 'r.expedienteadhoc_archivo_id')
        ->join('estado_revision as er', 'r.estado_revision_id', '=', 'er.id')
        ->where('ea.expedienteadhoc_id', $expedienteAdhocId)
        ->groupBy('r.estado_revision_id','er.id' )
        ->get();
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
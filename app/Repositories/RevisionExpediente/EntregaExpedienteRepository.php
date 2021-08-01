<?php
namespace App\Repositories\RevisionExpediente;

use App\Repositories\AbstractRepository;

use App\Repositories\RevisionExpediente\Interfaces\EntregaExpedienteRepositoryInterface;
use App\Models\RevisionExpediente\EntregaExpediente;
use App\Http\Requests\RevisionExpediente\EntregaExpedienteRequest;
use App\Http\Requests\RegistroExpedienteAdhoc\ExpedienteAdhocAddRequest;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhocArchivos;
use App\Models\RevisionExpediente\Revision;
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
                   eaa.recibo_pago, eaa.archivo_solicitud_ht, eaa.ht,

                   ee.id as estado_expediente_id, ee.nombre as estado_expediente_nombre,

                   ea.id AS expedienteadhoc_archivo_id, ea.valor AS valor_archivo,
                   a.id AS archivo_id, a.nombre AS nombre_archivo, a.slug AS slug_archivo,
                   padre.id id_padre, padre.nombre AS nombre_padre , padre.slug AS slug_padre,

                   adhoc.nombres AS adhoc_nombres,
                   adhoc.apellido_paterno as adhoc_apellido_paterno,
                   adhoc.apellido_materno as adhoc_apellido_materno,
                   adhoc.id as adhoc_id,

                   eee.id AS entregas_expediente_id,
                   eee.fecha_entrega,
                   eee.fecha_recepcion,

                   cenepred.nombres as cenepred_nombres,
                   cenepred.apellido_paterno as cenepred_apellido_paterno,
                   cenepred.apellido_materno as cenepred_apellido_materno,
                   cenepred.id as cenepred_id,

                   CONCAT( administrado.nombres , ' ',administrado.apellido_materno ) as administrado_full_name,
                   administrado.celular as administrado_celular,

                   r.id as revision_id,
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

            left join (
                select max(r.id) as revision_id , r.expedienteadhoc_archivo_id 
                from revisiones r
                group by r.expedienteadhoc_archivo_id 
            ) rr on ea.id = rr.expedienteadhoc_archivo_id

            LEFT JOIN revisiones AS r ON rr.revision_id = r.id
            LEFT JOIN estado_revision AS er ON r.estado_revision_id = er.id

            RIGHT JOIN archivos AS a on ea.archivo_id = a.id
            JOIN archivos AS padre on a.parent_id = padre.id 
            LEFT JOIN entregas_expedientes AS eee ON eaa.id = eee.expediente_adhoc_id
            LEFT JOIN acreditaciones AS aa ON eee.acreditacion_id = aa.id
            LEFT JOIN calificaciones AS c ON aa.calificacion_id = c.id
            LEFT JOIN users AS administrado ON eaa.usuario_id = administrado.id
            LEFT JOIN users AS adhoc ON c.usuario_id = adhoc.id
            LEFT JOIN users as cenepred ON eee.usuario_asignador_id = cenepred.id

            WHERE eaa.id = ? and a.convocatoria_id = ?

            GROUP BY eaa.id , ea.id , a.id, padre.id , ee.id, adhoc.id, r.id, er.id, eee.id, cenepred.id, administrado.id
            ORDER BY padre.id;",
            [$convocatoriaId,$expedienteAdhocId,$expedienteAdhocId,$convocatoriaId]
        );
    }
    public function getRevisiones($expedienteAdhocId)
    {
         $revisiones = Revision::from('revisiones as r')
                   ->select('r.expedienteadhoc_archivo_id', \DB::raw('max(r.id) as revision_id'))
                   ->groupBy('r.expedienteadhoc_archivo_id');

        return ExpedienteAdhocArchivos::from('expedienteadhoc_archivo as ea')
        ->select('r.estado_revision_id','er.nombre AS estado_revision',\DB::raw('count( r.id ) AS total'))
        ->joinSub( $revisiones, 'rr', function ($join) {
            $join->on('ea.id', '=', 'rr.expedienteadhoc_archivo_id');
        })
        ->join('revisiones as r', 'rr.revision_id', '=', 'r.id')
        ->join('estado_revision as er', 'r.estado_revision_id', '=', 'er.id')
        ->where('ea.expedienteadhoc_id', $expedienteAdhocId)
        ->groupBy('r.estado_revision_id','er.id' )
        ->get();
    }
    public function expedientes($request)
    {
        $query = ExpedienteAdhoc::from('expedientes_adhocs as ea')

            ->join('distritos','ea.distrito_id','=','distritos.id')
            ->join('provincias','distritos.provincia_id','=','provincias.id')
            ->join('departamentos','provincias.departamento_id','=','departamentos.id')
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
                'u.apellido_materno as administrado_apellido_materno',
                'u.id as administrado_id',
                'adhoc.nombres AS adhoc_nombres',
                'adhoc.apellido_paterno as adhoc_apellido_paterno',
                'adhoc.apellido_materno as adhoc_apellido_materno',
                'adhoc.id as adhoc_id',
                'ea.fecha_solicitud_ht',
                'ea.fecha_ingreso_ht',
                'ea.distrito_id',
                'departamentos.ubigeo',
                'distritos.provincia_id',
                'provincias.departamento_id',
                'departamentos.nombre as departamento_nombre',
                'cenepred.nombres as cenepred_nombres',
                'cenepred.apellido_paterno as cenepred_apellido_paterno',
                'cenepred.apellido_materno as cenepred_apellido_materno',
                'cenepred.id as cenepred_id'
            );
        
        return new $this->collectionNamePath(
            $query->filter($request)
            ->sort()
            ->paginate()
        );
        
    }
}
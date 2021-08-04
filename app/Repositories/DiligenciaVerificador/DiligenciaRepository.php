<?php
namespace App\Repositories\DiligenciaVerificador;

use App\Repositories\AbstractRepository;
use App\Models\DiligenciaVerificador\Diligencia;
use App\Repositories\DiligenciaVerificador\Interfaces\DiligenciaRepositoryInterface;
use App\Http\Resources\DiligenciaVerificador\Diligencia\DiligenciaCollection;
use App\Models\RevisionExpediente\Revision;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhocArchivos;
/**
 * 
 */
class DiligenciaRepository extends AbstractRepository implements DiligenciaRepositoryInterface
{

    protected $modelClassName = 'Diligencia';
    protected $modelClassNamePath = "App\Models\DiligenciaVerificador\Diligencia";
    protected $collectionNamePath = "App\Http\Resources\DiligenciaVerificador\Diligencia\DiligenciaCollection";
    protected $resourceNamePath = "App\Http\Resources\DiligenciaVerificador\Diligencia\DiligenciaResource";

    public function allToExport($request)
    {
        return new DiligenciaCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

    public function expedientes($request)
    {
        $query = Diligencia::from('diligencias as d')
            ->rightJoin('entregas_expedientes as eee', 'd.entrega_expediente_id', '=', 'eee.id')
            ->leftJoin('expedientes_adhocs as ea','eee.expediente_adhoc_id','=','ea.id')
            ->leftJoin('distritos','ea.distrito_id','=','distritos.id')
            ->leftJoin('provincias','distritos.provincia_id','=','provincias.id')
            ->leftJoin('departamentos','provincias.departamento_id','=','departamentos.id')
            ->leftJoin('estado_expediente as ee', 'ea.estado_expediente_id', '=', 'ee.id')
            ->leftJoin('users as u', 'ea.usuario_id', '=', 'u.id')

            ->leftJoin('acreditaciones as a', 'eee.acreditacion_id', '=', 'a.id')
            ->leftJoin('calificaciones as c', 'a.calificacion_id', '=', 'c.id')
            ->leftJoin('users as adhoc', 'c.usuario_id', '=', 'adhoc.id')
            ->leftJoin('users as cenepred', 'eee.usuario_asignador_id', '=', 'cenepred.id')
            ->select(
                'ea.id' , 'ea.nombre_comercial' , 'ea.direccion', 'ea.area',
                'ea.numero_operacion', 'ea.nombre_banco','ea.agencia',
                'ea.fecha_operacion', 'ea.monto',
                'ea.fecha_solicitud_ht',
                'ea.fecha_ingreso_ht',
                'ea.distrito_id',
                'ea.recibo_pago', 'ea.archivo_solicitud_ht', 'ea.ht',

                'ee.nombre as estado_expediente_nombre', 'ee.id as estado_expediente_id',
                'eee.id as entrega_expediente_id',
                'eee.fecha_recepcion',
                'eee.fecha_entrega',

                \DB::raw(
                    "CONCAT( u.nombres, ' ', u.apellido_paterno, ' ', u.apellido_materno) as administrado_full_name"
                ),
                'u.id as administrado_id',

                \DB::raw(
                    "CONCAT( adhoc.nombres, ' ', adhoc.apellido_paterno, ' ', adhoc.apellido_materno) as adhoc_full_name"
                ),
                'adhoc.id as adhoc_id',

                \DB::raw(
                    "CONCAT( cenepred.nombres, ' ', cenepred.apellido_paterno, ' ', cenepred.apellido_materno) as cenepred_full_name"
                ),
                'cenepred.id as cenepred_id',

                'departamentos.ubigeo',
                'distritos.provincia_id',
                'provincias.departamento_id',
                'departamentos.nombre as departamento_nombre',
                'd.fecha as fecha_diligencia',
                'd.anexo8',
                'd.anexo9',
                'd.anexo10'
            );

        return new $this->collectionNamePath(
            $query->filter($request)
            ->sort()
            ->paginate()
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
    public function getByConvocatoriaAndExpediente($convocatoriaId , $expedienteAdhocId ){

        return \DB::select("
            SELECT eee.id, eaa.nombre_comercial , eaa.direccion , eaa.area,
                   eaa.monto , eaa.nombre_banco , eaa.numero_operacion  ,
                   eaa.fecha_operacion , eaa.agencia ,  eaa.distrito_id ,
                   eaa.recibo_pago, eaa.archivo_solicitud_ht,
                   eaa.fecha_solicitud_ht,
                   eaa.fecha_ingreso_ht,
                   eaa.ht,
                   departamentos.nombre as departamento_nombre,
                   ee.id as estado_expediente_id, ee.nombre as estado_expediente_nombre,

                   ea.id AS expedienteadhoc_archivo_id, ea.valor AS valor_archivo,
                   a.id AS archivo_id, a.nombre AS nombre_archivo, a.slug AS slug_archivo,
                   padre.id id_padre, padre.nombre AS nombre_padre , padre.slug AS slug_padre,

                   CONCAT( u.nombres, ' ', u.apellido_paterno, ' ', u.apellido_materno) as administrado_full_name,
                
                   u.id as administrado_id,

                   ( SELECT count(id) AS total 
                       FROM archivos 
                       WHERE convocatoria_id = ? and level = 2 
                    )   AS total,
                   ( SELECT count(id) AS completados 
                       FROM expedienteadhoc_archivo 
                       WHERE expedienteadhoc_id = ? 
                    )   AS completados,
                    eee.id as entrega_expediente_id,
                    eee.fecha_recepcion,
                    eee.fecha_entrega,
                    d.fecha as fecha_diligencia,
                    d.anexo8,
                    d.anexo9,
                    d.anexo10
                    
            FROM diligencias as d
            RIGHT JOIN entregas_expedientes as eee ON d.entrega_expediente_id = eee.id
            LEFT JOIN expedientes_adhocs as eaa ON eee.expediente_adhoc_id = eaa.id

            LEFT JOIN distritos ON eaa.distrito_id = distritos.id
            LEFT JOIN provincias ON distritos.provincia_id = provincias.id
            LEFT JOIN departamentos ON provincias.departamento_id = departamentos.id
            LEFT JOIN estado_expediente ee on eaa.estado_expediente_id = ee.id
            LEFT JOIN users as u ON eaa.usuario_id = u.id
            LEFT JOIN expedienteadhoc_archivo ea on eaa.id = ea.expedienteadhoc_id 
            RIGHT JOIN archivos a on ea.archivo_id = a.id
            LEFT JOIN archivos AS padre on a.parent_id = padre.id 
            WHERE eaa.id = ? and a.convocatoria_id = ?

            GROUP BY eaa.id , ea.id , a.id, padre.id , ee.id, departamentos.id, d.id, eee.id, u.id
            ORDER BY padre.id;",
            [$convocatoriaId,$expedienteAdhocId,$expedienteAdhocId,$convocatoriaId]
        );
    }
    public function countDiligenciaByEntregaId( $entrega_expediente_id )
    {
        return Diligencia::where('entrega_expediente_id', $entrega_expediente_id)->count();
    }
}
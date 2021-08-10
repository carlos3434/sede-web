<?php
namespace App\Repositories\RegistroExpedienteAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\RegistroExpedienteAdhoc\Interfaces\ExpedienteAdhocRepositoryInterface;
use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc\ExpedienteAdhocExcelCollection;
use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc\ExpedienteAdhocCollection;
//use App\Http\Resources\RegistroAdhoc\Postulacion\PostulacionCollection;
//use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc;
/**
 * 
 */
class ExpedienteAdhocRepository extends AbstractRepository implements ExpedienteAdhocRepositoryInterface
{

    protected $modelClassName = 'ExpedienteAdhoc';
    protected $modelClassNamePath = "App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc";
    protected $collectionNamePath = "App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc\ExpedienteAdhocCollection";
    protected $resourceNamePath = "App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc\ExpedienteAdhocResource";

    public function getByConvocatoriaAndExpediente($convocatoriaId , $expedienteAdhocId ){
        return \DB::select("
            SELECT eaa.id, eaa.nombre_comercial , eaa.direccion , eaa.area,
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

                   r.id as revision_id,
                   r.observacion,
                   r.fecha_revision,
                   r.fecha_subsanacion,
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
                   
            FROM expedientes_adhocs eaa 
            LEFT JOIN distritos ON eaa.distrito_id = distritos.id
            LEFT JOIN provincias ON distritos.provincia_id = provincias.id
            LEFT JOIN departamentos ON provincias.departamento_id = departamentos.id
            LEFT JOIN estado_expediente ee on eaa.estado_expediente_id = ee.id
            LEFT JOIN expedienteadhoc_archivo ea on eaa.id = ea.expedienteadhoc_id 
            
            LEFT JOIN (
                select max(r.id) as revision_id , r.expedienteadhoc_archivo_id 
                from revisiones r
                group by r.expedienteadhoc_archivo_id 
            ) rr on ea.id = rr.expedienteadhoc_archivo_id

            LEFT JOIN revisiones AS r ON rr.revision_id = r.id
            LEFT JOIN estado_revision AS er ON r.estado_revision_id = er.id

            RIGHT JOIN archivos a on ea.archivo_id = a.id
            JOIN archivos AS padre on a.parent_id = padre.id 
            WHERE eaa.id = ? and a.convocatoria_id = ?

            GROUP BY eaa.id , ea.id , a.id, padre.id , ee.id, departamentos.id,
                    r.id, er.id
            ORDER BY padre.id;",
            [$convocatoriaId,$expedienteAdhocId,$expedienteAdhocId,$convocatoriaId]
        );
    }
}
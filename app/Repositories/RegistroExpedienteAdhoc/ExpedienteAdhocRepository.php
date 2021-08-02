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

                   ( SELECT count(id) AS total 
                       FROM archivos 
                       WHERE convocatoria_id = ? and level = 2 
                    )   AS total,
                   ( SELECT count(id) AS completados 
                       FROM expedienteadhoc_archivo 
                       WHERE expedienteadhoc_id = ? 
                    )   AS completados
                   
            FROM expedientes_adhocs eaa 
            JOIN distritos ON eaa.distrito_id = distritos.id
            JOIN provincias ON distritos.provincia_id = provincias.id
            JOIN departamentos ON provincias.departamento_id = departamentos.id
            JOIN estado_expediente ee on eaa.estado_expediente_id = ee.id
            LEFT JOIN expedienteadhoc_archivo ea on eaa.id = ea.expedienteadhoc_id 
            RIGHT JOIN archivos a on ea.archivo_id = a.id
            JOIN archivos AS padre on a.parent_id = padre.id 
            WHERE eaa.id = ? and a.convocatoria_id = ?

            GROUP BY eaa.id , ea.id , a.id, padre.id , ee.id, departamentos.id
            ORDER BY padre.id;",
            [$convocatoriaId,$expedienteAdhocId,$expedienteAdhocId,$convocatoriaId]
        );
    }
}
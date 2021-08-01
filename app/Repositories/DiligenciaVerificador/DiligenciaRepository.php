<?php
namespace App\Repositories\DiligenciaVerificador;

use App\Repositories\AbstractRepository;
use App\Models\DiligenciaVerificador\Diligencia;
use App\Repositories\DiligenciaVerificador\Interfaces\DiligenciaRepositoryInterface;
use App\Http\Resources\DiligenciaVerificador\Diligencia\DiligenciaCollection;

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
        //$query = ExpedienteAdhoc::from('expedientes_adhocs as ea')
        $query = Diligencia::from('diligencias as d')
            ->rightJoin('entregas_expedientes as eee', 'd.entrega_expediente_id', '=', 'eee.id')
            ->join('expedientes_adhocs as ea','eee.expediente_adhoc_id','=','ea.id')
            ->join('distritos','ea.distrito_id','=','distritos.id')
            ->join('provincias','distritos.provincia_id','=','provincias.id')
            ->join('departamentos','provincias.departamento_id','=','departamentos.id')
            ->join('estado_expediente as ee', 'ea.estado_expediente_id', '=', 'ee.id')
            ->join('users as u', 'ea.usuario_id', '=', 'u.id')

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
                'cenepred.id as cenepred_id',
                'd.fecha',
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

}
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
                'ea.id' , 'ea.nombre_comercial' , 'ea.direccion', 'ea.area',
                'ea.numero_operacion', 'ea.nombre_banco','ea.agencia',
                'ea.fecha_operacion', 'ea.monto',
                'ea.fecha_solicitud_ht',
                'ea.fecha_ingreso_ht',
                'ea.distrito_id',
                'ea.recibo_pago', 'ea.archivo_solicitud_ht', 'ea.ht',

                'ee.nombre as estado_expediente', 'ee.id as estado_id',
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

}
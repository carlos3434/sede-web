<?php
namespace App\Repositories\SeleccionAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\SeleccionAdhoc\Interfaces\AcreditacionRepositoryInterface;
use App\Http\Resources\SeleccionAdhoc\Acreditacion\AcreditacionExcelCollection;
use App\Http\Resources\SeleccionAdhoc\Acreditacion\AcreditacionCollection;
use App\Models\SeleccionAdhoc\Acreditacion;
use App\Models\SeleccionAdhoc\Puntaje;
/**
 * 
 */
class AcreditacionRepository extends AbstractRepository implements AcreditacionRepositoryInterface
{

    protected $modelClassName = 'Acreditacion';
    protected $modelClassNamePath = "App\Models\SeleccionAdhoc\Acreditacion";
    protected $collectionNamePath = "App\Http\Resources\SeleccionAdhoc\Acreditacion\AcreditacionCollection";
    protected $resourceNamePath = "App\Http\Resources\SeleccionAdhoc\Acreditacion\AcreditacionResource";

    public function countByCalificacionId($calificacion_id)
    {
        return Acreditacion::where('calificacion_id',$calificacion_id)->count();
    }
    public function sumPuntajeByCalificacionId($calificacion_id)
    {
        return Puntaje::where('calificacion_id',$calificacion_id)->sum('puntaje');
    }
    public function allToExport($request)
    {
        return new AcreditacionExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
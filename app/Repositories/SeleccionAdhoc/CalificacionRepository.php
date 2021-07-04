<?php
namespace App\Repositories\SeleccionAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\SeleccionAdhoc\Interfaces\CalificacionRepositoryInterface;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionExcelCollection;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionCollection;
use App\Models\SeleccionAdhoc\Calificacion;
/**
 * 
 */
class CalificacionRepository extends AbstractRepository implements CalificacionRepositoryInterface
{

    protected $modelClassName = 'Calificacion';
    protected $modelClassNamePath = "App\Models\SeleccionAdhoc\Calificacion";
    protected $collectionNamePath = "App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionCollection";
    protected $resourceNamePath = "App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionResource";

    public function getByUserId( $userId ) {
        return new CalificacionCollection(
            $this->getFilter($request)->sort()->get()
        );
    }
    public function getOneForDocumento( $userId ) {
        return new CalificacionCollection(
            Calificacion::where('usuario_id',$userId)
            //->sort()
            ->get()
        );
    }

    public function allToExport($request)
    {
        return new CalificacionExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
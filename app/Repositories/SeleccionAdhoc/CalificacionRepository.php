<?php
namespace App\Repositories\SeleccionAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\SeleccionAdhoc\Interfaces\CalificacionRepositoryInterface;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionExcelCollection;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionWithDetailCollection;
use App\Http\Resources\RegistroAdhoc\Postulacion\PostulacionCollection;
use App\Models\SeleccionAdhoc\Calificacion;
/**
 * 
 */
class CalificacionRepository extends AbstractRepository implements CalificacionRepositoryInterface
{

    protected $modelClassName = 'Calificacion';
    protected $modelClassNamePath = "App\Models\SeleccionAdhoc\Calificacion";
    protected $collectionNamePath = "App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionWithDetailCollection";
    protected $resourceNamePath = "App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionWithDetailResource";

    public function getByUserId( $userId ) {
        return new PostulacionCollection(
            Calificacion::where('usuario_id',$userId)
            ->get()
        );
    }
    public function getOneForDocumento( $userId ) {
        return new CalificacionWithDetailCollection(
            Calificacion::where('usuario_id',$userId)
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
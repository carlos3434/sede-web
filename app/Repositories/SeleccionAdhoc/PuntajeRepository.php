<?php
namespace App\Repositories\SeleccionAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\SeleccionAdhoc\Interfaces\PuntajeRepositoryInterface;
use App\Http\Resources\SeleccionAdhoc\Puntaje\PuntajeExcelCollection;
use App\Http\Resources\SeleccionAdhoc\Puntaje\PuntajeCollection;
use App\Models\SeleccionAdhoc\Puntaje;
/**
 * 
 */
class PuntajeRepository extends AbstractRepository implements PuntajeRepositoryInterface
{

    protected $modelClassName = 'Puntaje';
    protected $modelClassNamePath = "App\Models\SeleccionAdhoc\Puntaje";
    protected $collectionNamePath = "App\Http\Resources\SeleccionAdhoc\Puntaje\PuntajeCollection";
    protected $resourceNamePath = "App\Http\Resources\SeleccionAdhoc\Puntaje\PuntajeResource";

    public function getByUserId( $userId ) {
        return new PostulacionCollection(
            Puntaje::where('usuario_id',$userId)
            ->get()
        );
    }
    public function getOneForDocumento( $userId ) {
        return new PuntajeCollection(
            Puntaje::where('usuario_id',$userId)
            ->get()
        );
    }

    public function allToExport($request)
    {
        return new PuntajeExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
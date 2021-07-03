<?php
namespace App\Repositories\RegistroAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\RegistroAdhoc\Interfaces\VerificacionRealizadaRepositoryInterface;
use App\Http\Resources\RegistroAdhoc\VerificacionRealizada\VerificacionRealizadaExcelCollection;
/**
 * 
 */
class VerificacionRealizadaRepository extends AbstractRepository implements VerificacionRealizadaRepositoryInterface
{

    protected $modelClassName = 'VerificacionRealizada';
    protected $modelClassNamePath = "App\Models\RegistroAdhoc\VerificacionRealizada";
    protected $collectionNamePath = "App\Http\Resources\RegistroAdhoc\VerificacionRealizada\VerificacionRealizadaCollection";
    protected $resourceNamePath = "App\Http\Resources\RegistroAdhoc\VerificacionRealizada\VerificacionRealizadaResource";

    public function getByUserId( $userId ) {
        return new VerificacionRealizadaCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

    public function allToExport($request)
    {
        return new VerificacionRealizadaExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
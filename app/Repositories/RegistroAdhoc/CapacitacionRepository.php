<?php
namespace App\Repositories\RegistroAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\RegistroAdhoc\Interfaces\CapacitacionRepositoryInterface;
use App\Http\Resources\RegistroAdhoc\Capacitacion\CapacitacionExcelCollection;
/**
 * 
 */
class CapacitacionRepository extends AbstractRepository implements CapacitacionRepositoryInterface
{

    protected $modelClassName = 'Capacitacion';
    protected $modelClassNamePath = "App\Models\RegistroAdhoc\Capacitacion";
    protected $collectionNamePath = "App\Http\Resources\RegistroAdhoc\Capacitacion\CapacitacionCollection";
    protected $resourceNamePath = "App\Http\Resources\RegistroAdhoc\Capacitacion\CapacitacionResource";

    public function getByUserId( $userId ) {
        return new CapacitacionCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

    public function allToExport($request)
    {
        return new CapacitacionExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
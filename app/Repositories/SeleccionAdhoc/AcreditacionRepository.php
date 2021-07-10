<?php
namespace App\Repositories\SeleccionAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\SeleccionAdhoc\Interfaces\AcreditacionRepositoryInterface;
use App\Http\Resources\SeleccionAdhoc\Acreditacion\AcreditacionExcelCollection;
use App\Http\Resources\SeleccionAdhoc\Acreditacion\AcreditacionCollection;
use App\Models\SeleccionAdhoc\Acreditacion;
/**
 * 
 */
class AcreditacionRepository extends AbstractRepository implements AcreditacionRepositoryInterface
{

    protected $modelClassName = 'Acreditacion';
    protected $modelClassNamePath = "App\Models\SeleccionAdhoc\Acreditacion";
    protected $collectionNamePath = "App\Http\Resources\SeleccionAdhoc\Acreditacion\AcreditacionCollection";
    protected $resourceNamePath = "App\Http\Resources\SeleccionAdhoc\Acreditacion\AcreditacionResource";


    public function allToExport($request)
    {
        return new AcreditacionExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
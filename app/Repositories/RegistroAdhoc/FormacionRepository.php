<?php
namespace App\Repositories\RegistroAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\RegistroAdhoc\Interfaces\FormacionRepositoryInterface;
use App\Http\Resources\RegistroAdhoc\Formacion\FormacionExcelCollection;
/**
 * 
 */
class FormacionRepository extends AbstractRepository implements FormacionRepositoryInterface
{

    protected $modelClassName = 'Formacion';
    protected $modelClassNamePath = "App\Models\RegistroAdhoc\Formacion";
    protected $collectionNamePath = "App\Http\Resources\RegistroAdhoc\Formacion\FormacionCollection";
    protected $resourceNamePath = "App\Http\Resources\RegistroAdhoc\Formacion\FormacionResource";

    public function getByUserId( $userId ) {
        return new FormacionCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

    public function allToExport($request)
    {
        return new FormacionExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
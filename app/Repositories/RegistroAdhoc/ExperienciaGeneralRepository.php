<?php
namespace App\Repositories\RegistroAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\RegistroAdhoc\Interfaces\ExperienciaGeneralRepositoryInterface;
use App\Http\Resources\RegistroAdhoc\ExperienciaGeneral\ExperienciaGeneralExcelCollection;
/**
 * 
 */
class ExperienciaGeneralRepository extends AbstractRepository implements ExperienciaGeneralRepositoryInterface
{

    protected $modelClassName = 'ExperienciaGeneral';
    protected $modelClassNamePath = "App\Models\RegistroAdhoc\ExperienciaGeneral";
    protected $collectionNamePath = "App\Http\Resources\RegistroAdhoc\ExperienciaGeneral\ExperienciaGeneralCollection";
    protected $resourceNamePath = "App\Http\Resources\RegistroAdhoc\ExperienciaGeneral\ExperienciaGeneralResource";

    public function getByUserId( $userId ) {
        return new ExperienciaGeneralCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

    public function allToExport($request)
    {
        return new ExperienciaGeneralExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
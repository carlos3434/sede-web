<?php
namespace App\Repositories\RegistroAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\RegistroAdhoc\Interfaces\ExperienciaInspectorRepositoryInterface;
use App\Http\Resources\RegistroAdhoc\ExperienciaInspector\ExperienciaInspectorExcelCollection;
/**
 * 
 */
class ExperienciaInspectorRepository extends AbstractRepository implements ExperienciaInspectorRepositoryInterface
{

    protected $modelClassName = 'ExperienciaInspector';
    protected $modelClassNamePath = "App\Models\RegistroAdhoc\ExperienciaInspector";
    protected $collectionNamePath = "App\Http\Resources\RegistroAdhoc\ExperienciaInspector\ExperienciaInspectorCollection";
    protected $resourceNamePath = "App\Http\Resources\RegistroAdhoc\ExperienciaInspector\ExperienciaInspectorResource";

    public function getByUserId( $userId ) {
        return new ExperienciaInspectorCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

    public function allToExport($request)
    {
        return new ExperienciaInspectorExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
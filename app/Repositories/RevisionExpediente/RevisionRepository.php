<?php
namespace App\Repositories\RevisionExpediente;

use App\Repositories\AbstractRepository;

use App\Repositories\RevisionExpediente\Interfaces\RevisionRepositoryInterface;

/**
 * 
 */
class RevisionRepository extends AbstractRepository implements RevisionRepositoryInterface
{

    protected $modelClassName = 'RevisionExpediente';
    protected $modelClassNamePath = "App\Models\RevisionExpediente\Revision";
    protected $collectionNamePath = "App\Http\Resources\RevisionExpediente\Revision\RevisionCollection";
    protected $resourceNamePath = "App\Http\Resources\RevisionExpediente\Revision\RevisionResource";

    public function allToExport($request)
    {
        return new RevisionExcelCollection(
            $this->getFilter($request)->sort()->get()
        );
    }

}
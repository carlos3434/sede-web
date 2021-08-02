<?php
namespace App\Repositories\RevisionExpediente;

use App\Repositories\AbstractRepository;

use App\Repositories\RevisionExpediente\Interfaces\RevisionRepositoryInterface;
use App\Models\RevisionExpediente\Revision;
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

    public function getEstadoRevisionByArchivoId($expedienteadhoc_archivo_id)
    {
        return Revision::where('expedienteadhoc_archivo_id',$expedienteadhoc_archivo_id)
        ->orderBy('id', 'desc')
        ->first('estado_revision_id');
    }
}
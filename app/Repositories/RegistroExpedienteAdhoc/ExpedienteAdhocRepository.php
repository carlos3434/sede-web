<?php
namespace App\Repositories\RegistroExpedienteAdhoc;

use App\Repositories\AbstractRepository;
use App\Repositories\RegistroExpedienteAdhoc\Interfaces\ExpedienteAdhocRepositoryInterface;
use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc\ExpedienteAdhocExcelCollection;
use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc\ExpedienteAdhocCollection;
use App\Http\Resources\RegistroAdhoc\Postulacion\PostulacionCollection;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc;
/**
 * 
 */
class ExpedienteAdhocRepository extends AbstractRepository implements ExpedienteAdhocRepositoryInterface
{

    protected $modelClassName = 'ExpedienteAdhoc';
    protected $modelClassNamePath = "App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc";
    protected $collectionNamePath = "App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc\ExpedienteAdhocCollection";
    protected $resourceNamePath = "App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc\ExpedienteAdhocResource";


}
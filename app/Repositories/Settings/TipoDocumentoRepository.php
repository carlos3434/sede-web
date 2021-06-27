<?php
namespace App\Repositories\Settings;

use App\Repositories\AbstractRepository;
use App\Repositories\Settings\Interfaces\TipoDocumentoRepositoryInterface;
/**
 * 
 */
class TipoDocumentoRepository extends AbstractRepository implements TipoDocumentoRepositoryInterface
{

    protected $modelClassName = 'TipoDocumento';
    protected $modelClassNamePath = "App\Models\Settings\TipoDocumento";
    protected $collectionNamePath = "App\Http\Resources\Settings\TipoDocumento\TipoDocumentoCollection";
    protected $resourceNamePath = "App\Http\Resources\Settings\TipoDocumento\TipoDocumentoResource";
    

}
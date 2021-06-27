<?php
namespace App\Repositories\Settings;

use App\Repositories\AbstractRepository;
use App\Repositories\Settings\Interfaces\TipoInstitucionRepositoryInterface;
/**
 * 
 */
class TipoInstitucionRepository extends AbstractRepository implements TipoInstitucionRepositoryInterface
{

    protected $modelClassName = 'TipoInstitucion';
    protected $modelClassNamePath = "App\Models\Settings\TipoInstitucion";
    protected $collectionNamePath = "App\Http\Resources\Settings\TipoInstitucion\TipoInstitucionCollection";
    protected $resourceNamePath = "App\Http\Resources\Settings\TipoInstitucion\TipoInstitucionResource";
    

}
<?php
namespace App\Repositories\Settings;

use App\Repositories\AbstractRepository;
use App\Repositories\Settings\Interfaces\TipoCapacitacionRepositoryInterface;
/**
 * 
 */
class TipoCapacitacionRepository extends AbstractRepository implements TipoCapacitacionRepositoryInterface
{

    protected $modelClassName = 'TipoCapacitacion';
    protected $modelClassNamePath = "App\Models\Settings\TipoCapacitacion";
    protected $collectionNamePath = "App\Http\Resources\Settings\TipoCapacitacion\TipoCapacitacionCollection";
    protected $resourceNamePath = "App\Http\Resources\Settings\TipoCapacitacion\TipoCapacitacionResource";
    

}
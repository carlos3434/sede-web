<?php
namespace App\Repositories\Settings;

use App\Repositories\AbstractRepository;
use App\Repositories\Settings\Interfaces\ConfiguracionRepositoryInterface;
/**
 * 
 */
class ConfiguracionRepository extends AbstractRepository implements ConfiguracionRepositoryInterface
{

    protected $modelClassName = 'Configuracion';
    protected $modelClassNamePath = "App\Models\Settings\Configuracion";
    protected $collectionNamePath = "App\Http\Resources\Settings\Configuracion\ConfiguracionCollection";
    protected $resourceNamePath = "App\Http\Resources\Settings\Configuracion\ConfiguracionResource";
    

}
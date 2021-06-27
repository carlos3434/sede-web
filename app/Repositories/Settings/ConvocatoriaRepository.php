<?php
namespace App\Repositories\Settings;

use App\Repositories\AbstractRepository;
use App\Repositories\Settings\Interfaces\ConvocatoriaRepositoryInterface;
/**
 * 
 */
class ConvocatoriaRepository extends AbstractRepository implements ConvocatoriaRepositoryInterface
{

    protected $modelClassName = 'Convocatoria';
    protected $modelClassNamePath = "App\Models\Settings\Convocatoria";
    protected $collectionNamePath = "App\Http\Resources\Settings\Convocatoria\ConvocatoriaCollection";
    protected $resourceNamePath = "App\Http\Resources\Settings\Convocatoria\ConvocatoriaResource";
    

}
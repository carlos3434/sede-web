<?php
namespace App\Repositories\Settings;

use App\Repositories\AbstractRepository;
use App\Repositories\Settings\Interfaces\GradoRepositoryInterface;
/**
 * 
 */
class GradoRepository extends AbstractRepository implements GradoRepositoryInterface
{

    protected $modelClassName = 'Grado';
    protected $modelClassNamePath = "App\Models\Settings\Grado";
    protected $collectionNamePath = "App\Http\Resources\Settings\Grado\GradoCollection";
    protected $resourceNamePath = "App\Http\Resources\Settings\Grado\GradoResource";
    

}
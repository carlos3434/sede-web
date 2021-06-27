<?php
namespace App\Repositories\Settings;

use App\Repositories\AbstractRepository;
use App\Repositories\Settings\Interfaces\InstitucionRepositoryInterface;
/**
 * 
 */
class InstitucionRepository extends AbstractRepository implements InstitucionRepositoryInterface
{

    protected $modelClassName = 'Institucion';
    protected $modelClassNamePath = "App\Models\Settings\Institucion";
    protected $collectionNamePath = "App\Http\Resources\Settings\Institucion\InstitucionCollection";
    protected $resourceNamePath = "App\Http\Resources\Settings\Institucion\InstitucionResource";
    

}
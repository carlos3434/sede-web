<?php
namespace App\Repositories\Auth;

use App\Repositories\AbstractRepository;
use App\Repositories\Auth\Interfaces\RoleRepositoryInterface;
/**
 * 
 */
class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{

    protected $modelClassName = 'Role';
    protected $modelClassNamePath = "App\Models\Auth\Role";
    protected $collectionNamePath = "App\Http\Resources\Auth\Role\RoleCollection";
    protected $resourceNamePath = "App\Http\Resources\Auth\Role\RoleResource";
    

}
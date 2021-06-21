<?php
namespace App\Repositories\Auth;

use App\Repositories\AbstractRepository;
use App\Repositories\Auth\Interfaces\PermissionRepositoryInterface;
/**
 * 
 */
class PermissionRepository extends AbstractRepository implements PermissionRepositoryInterface
{

    protected $modelClassName = 'Permission';
    protected $modelClassNamePath = "App\Models\Auth\Permission";
    protected $collectionNamePath = "App\Http\Resources\Auth\Permission\PermissionCollection";
    protected $resourceNamePath = "App\Http\Resources\Auth\Permission\PermissionResource";
    

}
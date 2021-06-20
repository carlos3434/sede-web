<?php
namespace App\Repositories\Auth;

use App\Repositories\AbstractRepository;
//use App\User;
//use App\Http\Resources\Auth\User\UserCollection;
//use App\Http\Resources\Auth\User\UserResource;
use App\Http\Resources\Auth\User\UserForLogin;

use App\Repositories\Auth\Interfaces\UserRepositoryInterface;
/**
 * 
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    protected $modelClassName = 'User';
    protected $modelClassNamePath = "App\Models\Auth\User";
    protected $collectionNamePath = "App\Http\Resources\Auth\User\UserCollection";
    protected $resourceNamePath = "App\Http\Resources\Auth\User\UserResource";
    
    // This class only implements methods specific to the UserRepository
    public function findByUserName($username)
    {
        $where = call_user_func_array("{$this->modelClassName}::where", array($username));
        return $where->get();
    }
    public function getOneForLogin($user)
    {
        return new UserForLogin($user);
    }
}
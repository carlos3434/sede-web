<?php
namespace App\Repositories\Auth;

use App\Repositories\AbstractRepository;
use App\Http\Resources\Auth\User\UserForLogin;
use App\Http\Resources\Auth\User\UserForDocumento;

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
    public function getOneForDocumento($user)
    {
        return new UserForDocumento($user);
    }
    public function syncRolesAndPermissions($request, &$user)
    {
        if ($request->has('roles')) {//string
            $user->syncRoles( $request->get('roles') );
        }
        if ($request->has('permissions')) {
            $user->givePermissionTo( $request->get('permissions') );
        }
    }
}
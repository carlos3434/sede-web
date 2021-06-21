<?php
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\Role;
use App\Http\Requests\Auth\RoleRequest;
use App\Repositories\Auth\Interfaces\RoleRepositoryInterface;

class RoleController extends Controller
{
    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->RoleRepository = $roleRepository;
        /*
        $this->middleware('can:CREATE_Role')->only(['create','store']);
        $this->middleware('can:READ_Role')->only('index');
        $this->middleware('can:UPDATE_Role')->only(['edit','update']);
        $this->middleware('can:DETAIL_Role')->only('show');
        $this->middleware('can:DELETE_Role')->only('destroy');
        */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $filters)
    {
        return  $this->RoleRepository->all($filters);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $request->merge(['password' => bcrypt(12345678)]);
        $role = $this->RoleRepository->create($request->all());
        $this->RoleRepository->syncRolesAndPermissions($request, $role);
        return response()->json($role, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $this->RoleRepository->getOne($role);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role = $this->RoleRepository->updateOne($request, $role);
        $this->RoleRepository->syncRolesAndPermissions($request, $role);
        return response()->json($role, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->RoleRepository->deleteOne($role);
        return response()->json(null, 204);
    }
}
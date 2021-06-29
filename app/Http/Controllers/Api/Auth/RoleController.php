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
        $this->roleRepository = $roleRepository;
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
    public function index(Request $request)
    {
        return  $this->roleRepository->all($request);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roleRepository->create($request->all());
        $this->roleRepository->syncRolesAndPermissions($request, $role);
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
        return $this->roleRepository->getOne($role);
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
        $role = $this->roleRepository->updateOne( $request->all(), $role);
        $this->roleRepository->syncRolesAndPermissions($request, $role);
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
        $this->roleRepository->deleteOne($role);
        return response()->json(null, 204);
    }
}
<?php
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\Permission;
use App\Http\Requests\Auth\PermissionRequest;
use App\Repositories\Auth\Interfaces\PermissionRepositoryInterface;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        /*
        $this->middleware('can:CREATE_Permission')->only(['create','store']);
        $this->middleware('can:READ_Permission')->only('index');
        $this->middleware('can:UPDATE_Permission')->only(['edit','update']);
        $this->middleware('can:DETAIL_Permission')->only('show');
        $this->middleware('can:DELETE_Permission')->only('destroy');
        */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $filters)
    {
        return  $this->permissionRepository->all($filters);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $request->merge(['password' => bcrypt(12345678)]);
        $permission = $this->permissionRepository->create($request->all());
        $this->permissionRepository->syncRolesAndPermissions($request, $permission);
        return response()->json($permission, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return $this->permissionRepository->getOne($permission);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission = $this->permissionRepository->updateOne($request, $permission);
        $this->permissionRepository->syncRolesAndPermissions($request, $permission);
        return response()->json($permission, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->permissionRepository->deleteOne($permission);
        return response()->json(null, 204);
    }
}
<?php
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Http\Requests\Auth\UserRequest;
use App\Repositories\Auth\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

       // $this->middleware(['can:ACREDITACION_SHOW'])->only('show');
       // $this->middleware('permission:ACREDITACION_SHOW|ACREDITACION_SHOW')->only('show');
       // $this->middleware('role:ADMINISTRADOR')->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|USER_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|USER_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|USER_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|USER_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|USER_DESTROY'])->only('destroy');

        //USER_INDEX_DATA  

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $filters)
    {
        return  $this->userRepository->all($filters);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->merge(['password' => bcrypt(12345678)]);
        $user = $this->userRepository->create($request->all());
        $this->userRepository->syncRolesAndPermissions($request, $user);
        return response()->json($user, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->userRepository->getOne($user);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $request->merge(['password' => bcrypt(12345678)]);
        $user = $this->userRepository->updateOne($request, $user);
        $this->userRepository->syncRolesAndPermissions($request, $user);
        return response()->json($user, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userRepository->deleteOne($user);
        return response()->json(null, 204);
    }
}
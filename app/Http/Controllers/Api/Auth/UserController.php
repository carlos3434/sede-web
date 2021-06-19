<?php
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Auth\UserRequest;
use App\Repositories\Auth\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        /*
        $this->middleware('can:CREATE_USER')->only(['create','store']);
        $this->middleware('can:READ_USER')->only('index');
        $this->middleware('can:UPDATE_USER')->only(['edit','update']);
        $this->middleware('can:DETAIL_USER')->only('show');
        $this->middleware('can:DELETE_USER')->only('destroy');
        */
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
        //$this->syncRolesAndPermissions($request, $user);
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
        $user = $this->userRepository->updateOne($request, $user);
        //$this->syncRolesAndPermissions($request, $user);
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
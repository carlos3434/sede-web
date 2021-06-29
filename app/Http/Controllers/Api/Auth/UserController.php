<?php
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Http\Requests\Auth\UserRequest;
use App\Repositories\Auth\Interfaces\UserRepositoryInterface;
use App\Helpers\FileUploader;
class UserController extends Controller
{
    private $userRepository;
    private $fileUploader;

    public function __construct(UserRepositoryInterface $userRepository, FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
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
    public function index(Request $request)
    {
        return  $this->userRepository->all($request);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'constancias', 'constancia_habilidad');
        $all = $this->storeFile($request, $all, 'declaraciones', 'declaracion_jurada');
        $all = $this->storeFile($request, $all, 'dni', 'copia_dni');
        $all = $this->storeFile($request, $all, 'rj_itse', 'rj_itse');
        $all = $this->storeFile($request, $all, 'rj_verificador', 'rj_verificador');
        $all = $this->storeFile($request, $all, 'anexo_1', 'anexo_1');
        $all = $this->storeFile($request, $all, 'fotos', 'foto');
        $all['password'] = bcrypt( $request->get('password') );
        $user = $this->userRepository->create( $all );
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
    public function update(UserRequest $request, User $user )
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'constancias', 'constancia_habilidad');
        $all = $this->storeFile($request, $all, 'declaraciones', 'declaracion_jurada');
        $all = $this->storeFile($request, $all, 'dni', 'copia_dni');
        $all = $this->storeFile($request, $all, 'rj_itse', 'rj_itse');
        $all = $this->storeFile($request, $all, 'rj_verificador', 'rj_verificador');
        $all = $this->storeFile($request, $all, 'anexo_1', 'anexo_1');
        $all = $this->storeFile($request, $all, 'fotos', 'foto');
        $all['password'] = bcrypt( $request->get('password') );
        $user = $this->userRepository->updateOne($all, $user);
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

    private function storeFile( $request , $all , $folder, $fieldName ){
        if ( $request->hasFile($fieldName) ) {
            $fileValue = $this->fileUploader->upload(
                $request->file($fieldName),
                'files/'.$folder
            );
            $all[$fieldName] = $fileValue;
        }
        return $all;
    }
}
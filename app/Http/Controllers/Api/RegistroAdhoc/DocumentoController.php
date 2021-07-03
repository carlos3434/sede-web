<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DocumentoController extends Controller
{
    private $repository;
    private $fileUploader;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware(['role_or_permission:ADMINISTRADOR|USUARIO_DOCUMENTO_SHOW'])->only('index');
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
}
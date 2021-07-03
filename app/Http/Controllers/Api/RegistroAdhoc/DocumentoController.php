<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\UserDocumentoRequest;
use App\Models\Auth\User;

use App\Helpers\FileUploader;
class DocumentoController extends Controller
{
    private $repository;
    private $fileUploader;

    public function __construct(UserRepositoryInterface $repository, FileUploader $fileUploader )
    {
        $this->repository = $repository;
        $this->fileUploader = $fileUploader;
        $this->middleware(['role_or_permission:ADMINISTRADOR|USUARIO_DOCUMENTO_SHOW'])->only('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->getOneForDocumento(Auth::user());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExperienciaInspector  $experienciaInspector
     * @return \Illuminate\Http\Response
     */
    public function update( UserDocumentoRequest $request, User $user)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'declaraciones', 'declaracion_jurada');
        $all = $this->storeFile($request, $all, 'dni', 'copia_dni');
        $all = $this->storeFile($request, $all, 'rj_itse', 'rj_itse');
        $all = $this->storeFile($request, $all, 'rj_verificador', 'rj_verificador');
        $all = $this->storeFile($request, $all, 'anexo_1', 'anexo_1');
        $all = $this->storeFile($request, $all, 'fotos', 'foto');
        $user = $this->repository->updateOne($all, $user);

        return $this->repository->getOneForDocumento($user);
        return response()->json($user, 200);
    }

    private function storeFile( $request , $all , $folder, $fieldName ){
        if ( $request->hasFile($fieldName) ) {
            $fileValue = $this->fileUploader->upload(
                $request->file($fieldName),
                'files/'.$folder
            );
            $all[$fieldName] = $folder.'/'.$fileValue;
        }
        return $all;
    }
}
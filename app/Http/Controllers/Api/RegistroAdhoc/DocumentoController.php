<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
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
        return $this->repository->getOne(Auth::user());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExperienciaInspector  $experienciaInspector
     * @return \Illuminate\Http\Response
     */
    public function update(ExperienciaInspectorUpdateRequest $request, ExperienciaInspector $experienciaInspector)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'experienciaInspector', 'archivo_constancia');
        $experienciaInspector = $this->repository->updateOne($all, $experienciaInspector);
        return response()->json($experienciaInspector, 200);
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
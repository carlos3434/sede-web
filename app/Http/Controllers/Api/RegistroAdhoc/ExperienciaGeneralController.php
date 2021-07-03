<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistroAdhoc\ExperienciaGeneral;
use App\Http\Requests\RegistroAdhoc\ExperienciaGeneralAddRequest;
use App\Http\Requests\RegistroAdhoc\ExperienciaGeneralUpdateRequest;
use App\Repositories\RegistroAdhoc\Interfaces\ExperienciaGeneralRepositoryInterface;
use App\Helpers\FileUploader;
use Illuminate\Support\Facades\Auth;

class ExperienciaGeneralController extends Controller
{
    private $repository;
    private $fileUploader;

    public function __construct(ExperienciaGeneralRepositoryInterface $repository, FileUploader $fileUploader)
    {
        $this->repository = $repository;
        $this->fileUploader = $fileUploader;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_DESTROY'])->only('destroy');
        //mostrarExperienciaGeneralesUsuarioActual


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( !empty($request->excel) ){
            return $this->repository->allToExport($request)
            ->downloadExcel(
                'ExperienciaGeneral_'.date('m-d-Y_hia').'.xlsx',
                $writerType = null,
                $headings = true
            );
        }
        //$request['user_id'] = Auth::id();
        $request->request->add(['usuario_id' => Auth::id() ]);
        //$request->merge(["usuario_id" => Auth::id()]);
        return $this->repository->all($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienciaGeneralAddRequest $request)
    {
        $all = $request->all();
        $all['usuario_id'] = Auth::id();
        $all = $this->storeFile($request, $all, 'experienciaGeneral', 'archivo_constancia');
        $experienciaGeneral = $this->repository->create( $all );
        return response()->json($experienciaGeneral, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExperienciaGeneral $experienciaGeneral)
    {
        return $this->repository->getOne($experienciaGeneral);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExperienciaGeneral  $experienciaGeneral
     * @return \Illuminate\Http\Response
     */
    public function update(ExperienciaGeneralUpdateRequest $request, ExperienciaGeneral $experienciaGeneral)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'experienciaGeneral', 'archivo_constancia');
        $experienciaGeneral = $this->repository->updateOne($all, $experienciaGeneral);
        return response()->json($experienciaGeneral, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExperienciaGeneral  $experienciaGeneral
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExperienciaGeneral $experienciaGeneral)
    {
        $this->repository->deleteOne($experienciaGeneral);
        return response()->json(null, 204);
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
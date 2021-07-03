<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistroAdhoc\ExperienciaInspector;
use App\Http\Requests\RegistroAdhoc\ExperienciaInspectorAddRequest;
use App\Http\Requests\RegistroAdhoc\ExperienciaInspectorUpdateRequest;
use App\Repositories\RegistroAdhoc\Interfaces\ExperienciaInspectorRepositoryInterface;
use App\Helpers\FileUploader;
use Illuminate\Support\Facades\Auth;

class ExperienciaInspectorController extends Controller
{
    private $repository;
    private $fileUploader;

    public function __construct(ExperienciaInspectorRepositoryInterface $repository, FileUploader $fileUploader)
    {
        $this->repository = $repository;
        $this->fileUploader = $fileUploader;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_INSPECTOR_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_INSPECTOR_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_INSPECTOR_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_INSPECTOR_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_INSPECTOR_DESTROY'])->only('destroy');
        //mostrarExperienciaInspectoresUsuarioActual


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
                'ExperienciaInspector_'.date('m-d-Y_hia').'.xlsx',
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
    public function store(ExperienciaInspectorAddRequest $request)
    {
        $all = $request->all();
        $all['usuario_id'] = Auth::id();
        $all = $this->storeFile($request, $all, 'ExperienciaInspector', 'archivo_titulo');
        $experienciaInspector = $this->repository->create( $all );
        return response()->json($experienciaInspector, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExperienciaInspector $experienciaInspector)
    {
        return $this->repository->getOne($experienciaInspector);
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
        $all = $this->storeFile($request, $all, 'ExperienciaInspector', 'archivo_titulo');
        $experienciaInspector = $this->repository->updateOne($all, $experienciaInspector);
        return response()->json($experienciaInspector, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExperienciaInspector  $experienciaInspector
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExperienciaInspector $experienciaInspector)
    {
        $this->repository->deleteOne($experienciaInspector);
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
<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistroAdhoc\Formacion;
use App\Http\Requests\RegistroAdhoc\FormacionRequest;
use App\Repositories\RegistroAdhoc\Interfaces\FormacionRepositoryInterface;
use App\Helpers\FileUploader;
use Illuminate\Support\Facades\Auth;

class FormacionController extends Controller
{
    private $repository;
    private $fileUploader;

    public function __construct(FormacionRepositoryInterface $repository, FileUploader $fileUploader)
    {
        $this->repository = $repository;
        $this->fileUploader = $fileUploader;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_DESTROY'])->only('destroy');
        //mostrarFormacionesUsuarioActual


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
                'Formacion_'.date('m-d-Y_hia').'.xlsx',
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
    public function store(FormacionRequest $request)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'formacion', 'archivo_titulo');
        $formacion = $this->repository->create( $all );
        return response()->json($formacion, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Formacion $formacion)
    {
        return $this->repository->getOne($formacion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Formacion  $formacion
     * @return \Illuminate\Http\Response
     */
    public function update(FormacionRequest $request, Formacion $formacion)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'formacion', 'archivo_titulo');
        $formacion = $this->repository->updateOne($all, $formacion);
        return response()->json($formacion, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Formacion  $formacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formacion $formacion)
    {
        $this->repository->deleteOne($formacion);
        return response()->json(null, 204);
    }

    public function mostrarFormacionesUsuarioActual()
    {
        
        $datos['institucion'] = Institucion::select([
            'instituciones.id',
            'instituciones.nombre'
        ])
            ->leftjoin('tipos_instituciones', 'tipos_instituciones.id', '=', 'instituciones.tipo_institucion_id')
            //id=1 tipo de institucion es academica
            ->whereIn('tipos_instituciones.id', [1])
            ->orderBy('instituciones.nombre', 'asc')->get();
        $datos['grado_academico']=Grado::all();
        $usuario=Auth::user();
        $datos['user']=$usuario;
        return view('cvitae.formacion-academica',$datos);
        
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
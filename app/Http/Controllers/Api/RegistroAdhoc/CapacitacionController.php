<?php
namespace App\Http\Controllers\Api\RegistroAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistroAdhoc\Capacitacion;
use App\Http\Requests\RegistroAdhoc\CapacitacionAddRequest;
use App\Http\Requests\RegistroAdhoc\CapacitacionUpdateRequest;
use App\Repositories\RegistroAdhoc\Interfaces\CapacitacionRepositoryInterface;
use App\Helpers\FileUploader;
use Illuminate\Support\Facades\Auth;

class CapacitacionController extends Controller
{
    private $repository;
    private $fileUploader;

    public function __construct(CapacitacionRepositoryInterface $repository, FileUploader $fileUploader)
    {
        $this->repository = $repository;
        $this->fileUploader = $fileUploader;
        
        $this->middleware(['role_or_permission:ADMINISTRADOR|CAPACITACION_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|CAPACITACION_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|CAPACITACION_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|CAPACITACION_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|CAPACITACION_DESTROY'])->only('destroy');

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
                'Capacitacion_'.date('m-d-Y_hia').'.xlsx',
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
    public function store(CapacitacionAddRequest $request)
    {
        $all = $request->all();
        $all['usuario_id'] = Auth::id();
        $all = $this->storeFile($request, $all, 'capacitacion', 'certificado');
        $capacitacion = $this->repository->create( $all );
        return response()->json($capacitacion, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Capacitacion $capacitacion)
    {
        return $this->repository->getOne($capacitacion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Capacitacion  $capacitacion
     * @return \Illuminate\Http\Response
     */
    public function update(CapacitacionUpdateRequest $request, Capacitacion $capacitacion)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'capacitacion', 'certificado');
        $capacitacion = $this->repository->updateOne($all, $capacitacion);
        return response()->json($capacitacion, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Capacitacion  $capacitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capacitacion $capacitacion)
    {
        $this->repository->deleteOne($capacitacion);
        return response()->json(null, 204);
    }

    public function mostrarCapacitacionesUsuarioActual()
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
        return view('cvitae.Capacitacion-academica',$datos);
        
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
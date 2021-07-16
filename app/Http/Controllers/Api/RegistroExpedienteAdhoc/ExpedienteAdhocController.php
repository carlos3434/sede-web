<?php
namespace App\Http\Controllers\Api\RegistroExpedienteAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc;
use App\Http\Requests\RegistroExpedienteAdhoc\ExpedienteAdhocAddRequest;
use App\Http\Requests\RegistroExpedienteAdhoc\ExpedienteAdhocUpdateRequest;
use App\Repositories\RegistroExpedienteAdhoc\Interfaces\ExpedienteAdhocRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;
use App\Helpers\FileUploader;

class ExpedienteAdhocController extends Controller
{
    private $repository;
    private $fileUploader;


    public function __construct(ExpedienteAdhocRepositoryInterface $repository, FileUploader $fileUploader )
    {
        $this->repository = $repository;
        $this->fileUploader = $fileUploader;
        /*
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_DESTROY'])->only('destroy');*/
        //mostrarExpedienteAdhocesUsuarioActual


    }

    /**
     * muestra el listado de posstulaciones de la convocatoria actual
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( !empty($request->excel) ){
            return $this->repository->allToExport($request)
            ->downloadExcel(
                'ExpedienteAdhoc_'.date('m-d-Y_hia').'.xlsx',
                $writerType = null,
                $headings = true
            );
        }
        //por defecto traer todos las ExpedienteAdhoces del usuario logueado
        //$request->request->add( ['puntaje' => $request->input('puntaje', 0) ]);
        //$request->request->add( ['filtro'  => $request->input('filtro', '>=') ]);
        //solo de la convocatoria actual
        $request->request->add(['usuario_id' => Auth::id() ]);
        return $this->repository->all($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpedienteAdhocAddRequest $request)
    {
        $all = $request->all();
        $all['usuario_id'] = Auth::id();
        $all['estado_expediente_id'] = 1;
        //$all = $this->storeFile($request, $all, 'constancias', 'constancia_habilidad');
       // $all = $this->storeFile($request, $all, 'ExpedienteAdhoc', 'archivo_titulo');
        $expedienteAdhoc = $this->repository->create( $all );
        return response()->json($expedienteAdhoc, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExpedienteAdhoc $expedienteAdhoc)
    {
        return $this->repository->getOne($expedienteAdhoc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpedienteAdhoc  $expedienteAdhoc
     * @return \Illuminate\Http\Response
     */
    public function update(ExpedienteAdhocUpdateRequest $request, ExpedienteAdhoc $expedienteAdhoc)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'ExpedienteAdhoc', 'archivo_titulo');
        $expedienteAdhoc = $this->repository->updateOne($all, $expedienteAdhoc);
        return response()->json($expedienteAdhoc, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpedienteAdhoc  $expedienteAdhoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpedienteAdhoc $expedienteAdhoc)
    {
        $this->repository->deleteOne($expedienteAdhoc);
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
<?php
namespace App\Http\Controllers\Api\RevisionExpediente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\FileUploader;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\ProcessSentEmail;

use App\Repositories\RevisionExpediente\Interfaces\EntregaExpedienteRepositoryInterface;

use App\Models\RevisionExpediente\EntregaExpediente;
use App\Http\Requests\RevisionExpediente\EntregaExpedienteRequest;
use App\Models\Settings\EstadoExpedienteAdhoc;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc;
use App\Models\Settings\Convocatoria;
use App\Http\Resources\RevisionExpediente\EntregaExpediente\EntregaExpedienteResource;

class EntregaExpedienteController extends Controller
{
    private $repository;
    //private $fileUploader;


    public function __construct( EntregaExpedienteRepositoryInterface $repository/*, FileUploader $fileUploader*/ )
    {
        $this->repository = $repository;
        //$this->fileUploader = $fileUploader;
        /*
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_DESTROY'])->only('destroy');*/

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
                'EntregaExpediente_'.date('m-d-Y_hia').'.xlsx',
                $writerType = null,
                $headings = true
            );
        }

        if (!$request->has('estado_expediente_id')) {
            $request->request->add(['estado_expediente_id' => [3,4,5,6,7] ]);
        }

        return $this->repository->expedientes($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(EntregaExpedienteRequest $request)
    public function store(EntregaExpedienteRequest $request)
    {
        $all = $request->all();
        $all['usuario_asignador_id'] = Auth::id();
        $all['fecha_entrega'] = date("Y-m-d");
        $expedienteAdhocId = $request->get('expediente_adhoc_id');
        $entregaExpediente = $this->repository->create( $all );
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;
        if (!$convocatoriaId) {
            return [];
        }
        //cambiar el estado del expediente a Entregado
        $expedienteAdhoc = ExpedienteAdhoc::find($expedienteAdhocId);
        $expedienteAdhoc->update(['estado_expediente_id' => EstadoExpedienteAdhoc::ENTREGADO]);
         

        $result = $this->repository->getByConvocatoriaAndExpediente( $convocatoriaId , $expedienteAdhocId );
        $revisiones = $this->repository->getRevisiones( $expedienteAdhocId );
        return response()->json( new EntregaExpedienteResource( $result , $revisiones ) , 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $expedienteAdhocId )
    {
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;
        if (!$convocatoriaId) {
            return [];
        }
        $result = $this->repository->getByConvocatoriaAndExpediente( $convocatoriaId , $expedienteAdhocId );
        $revisiones = $this->repository->getRevisiones( $expedienteAdhocId );
        return response()->json( new EntregaExpedienteResource( $result , $revisiones) , 200 );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntregaExpediente  $entregaExpediente
     * @return \Illuminate\Http\Response
     */
    /*public function update(EntregaExpedienteRequest $request, EntregaExpediente $entregaExpediente)
    {
        $all = $request->all();
        if ($request->has('archivo')) {
            //validar que el archivoId exista en el EntregaExpediente
            foreach ($request->archivo as $key => $archivo) {

                $fileValue = $this->storeFile($request, 'expediente_adhoc_archivos', 'archivo.' .$key.'.valor');

                $entregaExpediente->archivos()->updateExistingPivot(
                    $archivo['id'] , [
                        'valor' =>  $fileValue,
                    ]
                );
            }
        }

        $entregaExpediente = $this->repository->updateOne($all, $entregaExpediente);
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;

        $result = $this->repository->getByConvocatoriaAndExpediente( $convocatoriaId , $entregaExpediente->id );
        return response()->json( new EntregaExpedienteArchivoResource( $result ) , 200 );
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntregaExpediente  $entregaExpediente
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(EntregaExpediente $entregaExpediente)
    {
        //primero eliminar los archivos relacionados EntregaExpedienteArchivos
        $entregaExpediente->archivos()->detach();
        $this->repository->deleteOne($entregaExpediente);
        return response()->json(null, 204);
    }*/

}
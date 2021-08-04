<?php
namespace App\Http\Controllers\Api\DiligenciaVerificador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\FileUploader;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\ProcessSentEmail;

use App\Repositories\DiligenciaVerificador\Interfaces\DiligenciaRepositoryInterface;

use App\Http\Requests\DiligenciaVerificador\DiligenciaAddRequest;
use App\Models\Settings\EstadoExpedienteAdhoc;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc;
use App\Models\RevisionExpediente\EntregaExpediente;
use App\Models\Settings\Convocatoria;
use App\Http\Resources\DiligenciaVerificador\Diligencia\DiligenciaResource;

use App\Http\Resources\DiligenciaVerificador\Diligencia\DiligenciaCollection;

class DiligenciaVerificadorController extends Controller
{
    private $repository;

    public function __construct( DiligenciaRepositoryInterface $repository)
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
            $request->request->add(['estado_expediente_id' => [5,6,7] ]);
        }
        $request->request->add(['verificador_id' => Auth::id() ]);//usuario verificador adhoc

        return $this->repository->expedientes($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiligenciaAddRequest $request)
    {
        //update expediente
        $entregaExpediente = EntregaExpediente::find($request->entrega_expediente_id);
        $entregaExpediente->update(['fecha_recepcion' => date("Y-m-d H:i:s")]);
        $entregaExpediente->expediente()->update([
            'estado_expediente_id' => EstadoExpedienteAdhoc::RECIBIDO
        ]);

        //create diligencia
        $diligencia = $this->repository->create( $request->all() );
         
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;
        if (!$convocatoriaId) {
            return [];
        }

        $result = $this->repository->getByConvocatoriaAndExpediente( $convocatoriaId , $entregaExpediente->expediente->id );
        $revisiones = $this->repository->getRevisiones( $entregaExpediente->expediente->id );
        return response()->json( new DiligenciaResource( $result , $revisiones) , 201 );
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
        return response()->json( new DiligenciaResource( $result , $revisiones) , 200 );
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntregaExpediente  $entregaExpediente
     * @return \Illuminate\Http\Response
     */
    public function update(EntregaExpedienteRequest $request, EntregaExpediente $entregaExpediente)
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
    }

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
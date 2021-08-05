<?php
namespace App\Http\Controllers\Api\DiligenciaVerificador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\FileUploader;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ProcessEnviarAnexo10;

use App\Repositories\DiligenciaVerificador\Interfaces\DiligenciaRepositoryInterface;

use App\Http\Requests\DiligenciaVerificador\DiligenciaAddRequest;
use App\Http\Requests\DiligenciaVerificador\DiligenciaUpdate9Request;
use App\Http\Requests\DiligenciaVerificador\DiligenciaUpdate10Request;
use App\Models\Settings\EstadoExpedienteAdhoc;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc;
use App\Models\RevisionExpediente\EntregaExpediente;
use App\Models\Settings\Convocatoria;
use App\Http\Resources\DiligenciaVerificador\Diligencia\DiligenciaResource;
use App\Models\DiligenciaVerificador\Diligencia;
use App\Http\Resources\DiligenciaVerificador\Diligencia\DiligenciaCollection;
use Illuminate\Support\Facades\Storage;

class DiligenciaVerificadorController extends Controller
{
    private $repository;
    private $fileUploader;

    public function __construct( DiligenciaRepositoryInterface $repository, FileUploader $fileUploader)
    {
        $this->repository = $repository;
        $this->fileUploader = $fileUploader;
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
        //validar si ya se registro diligencia
        $diligenciaDB = $this->repository->countDiligenciaByEntregaId( $request->entrega_expediente_id );
        if ($diligenciaDB>0) {
            return response()->json(['message' => "Ya se encuentra registrado una diligencia para este expediente entregado" ], 422);
        }
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'anexo8', 'anexo8');

        //update expediente
        $entregaExpediente = EntregaExpediente::find($request->entrega_expediente_id);
        $entregaExpediente->update(['fecha_recepcion' => date("Y-m-d H:i:s")]);
        $entregaExpediente->expediente()->update([
            'estado_expediente_id' => EstadoExpedienteAdhoc::RECIBIDO
        ]);

        //create diligencia
        $diligencia = $this->repository->create( $all );
         
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
    public function updateAnexo9(DiligenciaUpdate9Request $request , Diligencia $diligencia )
    {
        $all = $request->all();
        $all['fecha_diligencia'] = date("Y-m-d H:i:s");
        //estado de expediente => PROGRAMADO
        $all = $this->storeFile($request, $all, 'anexo9', 'anexo9');
        $this->repository->updateOne($all, $diligencia);
        $diligencia->entrega->expediente()->update(['estado_expediente_id' => EstadoExpedienteAdhoc::PROGRAMADO]);
        return response()->json($diligencia, 200);
    }
    public function updateAnexo10(DiligenciaUpdate10Request $request , Diligencia $diligencia )
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'anexo10', 'anexo10');
        $this->repository->updateOne($all, $diligencia);
        $diligencia->entrega->expediente()->update(['estado_expediente_id' => EstadoExpedienteAdhoc::INFORMEENTREGADO]);
        //sent an email
        $adjuntos = [
           Storage::path("uploads/files/".$all['anexo10']),
        ];

        dispatch( new ProcessEnviarAnexo10( Auth::user(), $adjuntos ) );
        \Illuminate\Support\Facades\Mail::to(['mesadepartes@cenepred.gob.pe'])->send(new \App\Mail\EnviarAnexo10(Auth::user(), $adjuntos));
        return response()->json($diligencia, 200);
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
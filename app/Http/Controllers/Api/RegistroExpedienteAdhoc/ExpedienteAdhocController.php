<?php
namespace App\Http\Controllers\Api\RegistroExpedienteAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc;
use App\Http\Requests\RegistroExpedienteAdhoc\ExpedienteAdhocAddRequest;
use App\Http\Requests\RegistroExpedienteAdhoc\ExpedienteAdhocUpdateRequest;
use App\Http\Requests\RegistroExpedienteAdhoc\ExpedienteAdhocAddHojaTramiteRequest;
use App\Http\Requests\RegistroExpedienteAdhoc\ExpedienteAdhocAddVerificacionAdhocRequest;
use App\Repositories\RegistroExpedienteAdhoc\Interfaces\ExpedienteAdhocRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;
use App\Helpers\FileUploader;
use Carbon\Carbon;
use App\Mail\SolicitarHojaTramite;
use Illuminate\Support\Facades\Mail;
use App\Jobs\ProcessSentEmail;
use App\Models\RegistroExpedienteAdhoc\Archivo;

use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhocArchivo\ExpedienteAdhocArchivoCollection;
use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhocArchivo\ExpedienteAdhocArchivoResource;
use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc\ExpedienteAdhocCollection;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhocArchivos;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings\EstadoExpedienteAdhoc;

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
        $all['estado_expediente_id'] = EstadoExpedienteAdhoc::CREADO;

        $expedienteAdhoc = $this->repository->create( $all );
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;
        if ($convocatoriaId) {
            //traer todos los archivos de la actual convocatoria
            $archivos = Archivo::GetArchivosByConvocatoriaId( $convocatoriaId );
            $expedienteAdhoc->expedienteAdhocArchivos()->createMany( $archivos->toArray() );
        }
        //consultar los archivos y sus observaciones
        $result = $this->repository->getByConvocatoriaAndExpediente( $convocatoriaId , $expedienteAdhoc->id );

        return response()->json( new ExpedienteAdhocArchivoResource( $result ) , 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExpedienteAdhoc $expedienteAdhoc)
    {
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;
        if (!$convocatoriaId) {
            return [];
        }
        $result = $this->repository->getByConvocatoriaAndExpediente( $convocatoriaId , $expedienteAdhoc->id );

        return response()->json( new ExpedienteAdhocArchivoResource( $result ) , 200 );
    }
    public function solicitarHojaTramite(ExpedienteAdhocAddHojaTramiteRequest $request, ExpedienteAdhoc $expedienteAdhoc)
    {
        $fields = $request->only($request->getFillableForAddHojaTramite());

        $fields = $this->storeFileField($request, $fields, 'recibo_pago', 'recibo_pago');
        $fields = $this->storeFileField($request, $fields, 'archivo_solicitud_ht', 'archivo_solicitud_ht');

        $fields['fecha_solicitud_ht'] = Carbon::now()->toDateTimeString();
        $fields['estado_expediente_id'] = EstadoExpedienteAdhoc::HOJATRAMITE;

        $expedienteAdhoc = $this->repository->updateOne($fields, $expedienteAdhoc);

        $adjuntos = [
            Storage::path("uploads/files/".$fields['recibo_pago']),
            Storage::path("uploads/files/".$fields['archivo_solicitud_ht']),
        ];

        dispatch( new ProcessSentEmail( Auth::user(), $adjuntos ) );

        return $expedienteAdhoc;
    }
    public function solicitarVerificacionAdhoc(ExpedienteAdhocAddVerificacionAdhocRequest $request, ExpedienteAdhoc $expedienteAdhoc)
    {
        $fields = $request->only($request->getFillableForVerificacionAdhoc());

        $fields['estado_expediente_id'] = EstadoExpedienteAdhoc::SOLICITUDVERIFICACION;
        $fields['fecha_ingreso_ht'] = Carbon::now()->toDateTimeString();

        $expedienteAdhoc = $this->repository->updateOne($fields, $expedienteAdhoc);
        return $expedienteAdhoc;
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
        if ($request->has('archivo')) {
            //validar que el archivoId exista en el expedienteadhoc
            foreach ($request->archivo as $key => $archivo) {

                $fileValue = $this->storeFile($request, 'expediente_adhoc_archivos', 'archivo.' .$key.'.valor');

                $expedienteAdhoc->archivos()->updateExistingPivot(
                    $archivo['id'] , [
                        'valor' =>  $fileValue,
                    ]
                );
            }
        }

        $expedienteAdhoc = $this->repository->updateOne($all, $expedienteAdhoc);
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;

        $result = $this->repository->getByConvocatoriaAndExpediente( $convocatoriaId , $expedienteAdhoc->id );
        return response()->json( new ExpedienteAdhocArchivoResource( $result ) , 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpedienteAdhoc  $expedienteAdhoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpedienteAdhoc $expedienteAdhoc)
    {
        //primero eliminar los archivos relacionados ExpedienteAdhocArchivos
        $expedienteAdhoc->archivos()->detach();
        $this->repository->deleteOne($expedienteAdhoc);
        return response()->json(null, 204);
    }

    public function destroyArchivo(ExpedienteAdhoc $expedienteAdhoc, Archivo $archivo)
    {
        $expArch = ExpedienteAdhocArchivos::select('id','valor')
        ->where('expedienteadhoc_id',$expedienteAdhoc->id)
        ->where('archivo_id',$archivo->id)
        ->first();

        $result= false;
        if (isset($expArch)) {
            $fieldName = $expArch->valor;
            $result = $expArch->update(['valor'=>null]);
            $this->fileUploader->destroyStorage($fieldName);
        }

        return response()->json(['success' => $result], 204);
    }

    private function storeFileField( $request , $all , $folder, $fieldName )
    {
        if ( $request->hasFile($fieldName) ) {
            $fileValue = $this->fileUploader->upload(
                $request->file($fieldName),
                'files/'.$folder
            );
            $all[$fieldName] = $folder.'/'.$fileValue;
        }
        return $all;
    }

    private function storeFile( $request , $folder, $fieldName )
    {
        $fileValue= '';
        if ( $request->hasFile($fieldName) ) {

            $fileValue = $this->fileUploader->upload(
                $request->file($fieldName),
                'files/'.$folder
            );
            //$all[$fieldName] = $folder.'/'.$fileValue;
            
        }
        return $folder.'/'.$fileValue;
    }
}
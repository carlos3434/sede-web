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
/*

use App\Http\Requests\RegistroEntregaExpediente\EntregaExpedienteAddRequest;
use App\Http\Requests\RegistroEntregaExpediente\EntregaExpedienteUpdateRequest;
use App\Http\Requests\RegistroEntregaExpediente\EntregaExpedienteAddHojaTramiteRequest;
use App\Http\Requests\RegistroEntregaExpediente\EntregaExpedienteAddVerificacionAdhocRequest;
use App\Models\Settings\Convocatoria;
use App\Mail\SolicitarHojaTramite;
use App\Models\RegistroEntregaExpediente\Archivo;
use App\Http\Resources\RegistroEntregaExpediente\EntregaExpedienteArchivo\EntregaExpedienteArchivoCollection;
use App\Http\Resources\RegistroEntregaExpediente\EntregaExpedienteArchivo\EntregaExpedienteArchivoResource;
use App\Http\Resources\RegistroEntregaExpediente\EntregaExpediente\EntregaExpedienteCollection;
use App\Models\RegistroEntregaExpediente\EntregaExpedienteArchivos;
*/

class EntregaExpedienteController extends Controller
{
    private $repository;
    //private $fileUploader;


    public function __construct(EntregaExpedienteRepositoryInterface $repository/*, FileUploader $fileUploader*/ )
    {
        $this->repository = $repository;
        //$this->fileUploader = $fileUploader;
        /*
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPEDIENTE_ADHOC_DESTROY'])->only('destroy');*/
        //mostrarEntregaExpedienteesUsuarioActual


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
        //por defecto traer todos las EntregaExpedientees del usuario logueado
        //$request->request->add( ['puntaje' => $request->input('puntaje', 0) ]);
        //$request->request->add( ['filtro'  => $request->input('filtro', '>=') ]);
        //solo de la convocatoria actual
        //$request->request->add(['usuario_id' => Auth::id() ]);
        return $this->repository->expedientes($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntregaExpedienteRequest $request)
    {
        $all = $request->all();
        $all['usuario_id'] = Auth::id();
        $all['estado_expediente_id'] = 1;//CREADO

        $entregaExpediente = $this->repository->create( $all );
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;
        if ($convocatoriaId) {
            //traer todos los archivos de la actual convocatoria
            $archivos = Archivo::GetArchivosByConvocatoriaId( $convocatoriaId );
            $entregaExpediente->EntregaExpedienteArchivos()->createMany( $archivos->toArray() );
        }
        //consultar los archivos y sus observaciones
        $result = $this->repository->get( $convocatoriaId , $entregaExpediente->id );

        return response()->json( new EntregaExpedienteArchivoResource( $result ) , 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EntregaExpediente $entregaExpediente)
    {
        $convocatoriaId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id: false;
        if (!$convocatoriaId) {
            return [];
        }
        $result = $this->repository->getByConvocatoriaAndExpediente( $convocatoriaId , $entregaExpediente->id );

        return response()->json( new EntregaExpedienteResource( $result ) , 200 );
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
    public function destroy(EntregaExpediente $entregaExpediente)
    {
        //primero eliminar los archivos relacionados EntregaExpedienteArchivos
        $entregaExpediente->archivos()->detach();
        $this->repository->deleteOne($entregaExpediente);
        return response()->json(null, 204);
    }

}
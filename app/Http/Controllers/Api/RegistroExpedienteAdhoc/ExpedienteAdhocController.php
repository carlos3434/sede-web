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
        $all['estado_expediente_id'] = 1;//CREADO
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
    public function solicitarHojaTramite(ExpedienteAdhocAddHojaTramiteRequest $request, ExpedienteAdhoc $expedienteAdhoc)
    {
        $fields = $request->only($request->getFillableForAddHojaTramite());

        $fields = $this->storeFile($request, $fields, 'recibo_pago', 'recibo_pago');
        $fields = $this->storeFile($request, $fields, 'archivo_solicitud_ht', 'archivo_solicitud_ht');

        $fields['fecha_solicitud_ht'] = Carbon::now()->toDateTimeString();
        $fields['estado_expediente_id'] = 2;//HOJA DE TRAMITE

        $expedienteAdhoc = $this->repository->updateOne($fields, $expedienteAdhoc);

        $adjuntos = [
            storage_path('app/uploads/files/'.$fields['recibo_pago']),
            storage_path('app/uploads/files/'.$fields['archivo_solicitud_ht'])
        ];

        dispatch( new ProcessSentEmail( Auth::user(), $adjuntos ) );

        return $expedienteAdhoc;
    }
    public function solicitarVerificacionAdhoc(ExpedienteAdhocAddVerificacionAdhocRequest $request, ExpedienteAdhoc $expedienteAdhoc)
    {
        $fields = $request->only($request->getFillableForVerificacionAdhoc());

        $fields['estado_expediente_id'] = 3;//SOLICITUD VERIFICACION
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
        $all = $this->storeFile($request, $all, 'constancias', 'constancia_habilidad');
        $all = $this->storeFile($request, $all, 'declaraciones', 'declaracion_jurada');
        $all = $this->storeFile($request, $all, 'dni', 'copia_dni');
        $all = $this->storeFile($request, $all, 'rj_itse', 'rj_itse');
        $all = $this->storeFile($request, $all, 'rj_verificador', 'rj_verificador');
        $all = $this->storeFile($request, $all, 'anexo_1', 'anexo_1');
        $all = $this->storeFile($request, $all, 'fotos', 'foto');

        $all = $this->storeFile($request, $all, 'carta_poder_simple', 'carta_poder_simple');
        $all = $this->storeFile($request, $all, 'copia_vigencia_poder', 'copia_vigencia_poder');
        $all = $this->storeFile($request, $all, 'copia_partida_registral', 'copia_partida_registral');
        $all = $this->storeFile($request, $all, 'copia_dni_propietario', 'copia_dni_propietario');
        //$all = $this->storeFile($request, $all, 'recibo_pago', 'recibo_pago');
        $all = $this->storeFile($request, $all, 'copia_formulario_for', 'copia_formulario_for');
        $all = $this->storeFile($request, $all, 'informe_tecnico_verificador_responsable', 'informe_tecnico_verificador_responsable');
        $all = $this->storeFile($request, $all, 'esquela_observacion_sunarp', 'esquela_observacion_sunarp');
        $all = $this->storeFile($request, $all, 'memoria_descriptiva_seguridad', 'memoria_descriptiva_seguridad');
        $all = $this->storeFile($request, $all, 'certificado_pozo_tierra', 'certificado_pozo_tierra');
        $all = $this->storeFile($request, $all, 'certificado_laminados', 'certificado_laminados');
        $all = $this->storeFile($request, $all, 'certificado_sistema_electrico', 'certificado_sistema_electrico');

        $all = $this->storeFile($request, $all, 'plano_ubicacion_01', 'plano_ubicacion_01');
        $all = $this->storeFile($request, $all, 'plano_ubicacion_02', 'plano_ubicacion_02');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_1', 'plano_arquitectura_1');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_2', 'plano_arquitectura_2');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_3', 'plano_arquitectura_3');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_4', 'plano_arquitectura_4');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_5', 'plano_arquitectura_5');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_6', 'plano_arquitectura_6');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_7', 'plano_arquitectura_7');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_8', 'plano_arquitectura_8');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_9', 'plano_arquitectura_9');
        $all = $this->storeFile($request, $all, 'plano_arquitectura_10', 'plano_arquitectura_10');

        $all = $this->storeFile($request, $all, 'plano_fabrica_1', 'plano_fabrica_1');
        $all = $this->storeFile($request, $all, 'plano_fabrica_2', 'plano_fabrica_2');
        $all = $this->storeFile($request, $all, 'plano_fabrica_3', 'plano_fabrica_3');
        $all = $this->storeFile($request, $all, 'plano_fabrica_4', 'plano_fabrica_4');
        $all = $this->storeFile($request, $all, 'plano_fabrica_5', 'plano_fabrica_5');
        $all = $this->storeFile($request, $all, 'plano_fabrica_6', 'plano_fabrica_6');
        $all = $this->storeFile($request, $all, 'plano_fabrica_7', 'plano_fabrica_7');
        $all = $this->storeFile($request, $all, 'plano_fabrica_8', 'plano_fabrica_8');
        $all = $this->storeFile($request, $all, 'plano_fabrica_9', 'plano_fabrica_9');
        $all = $this->storeFile($request, $all, 'plano_fabrica_10', 'plano_fabrica_10');

        $all = $this->storeFile($request, $all, 'plano_remodelacion_1', 'plano_remodelacion_1');
        $all = $this->storeFile($request, $all, 'plano_remodelacion_2', 'plano_remodelacion_2');
        $all = $this->storeFile($request, $all, 'plano_remodelacion_3', 'plano_remodelacion_3');
        $all = $this->storeFile($request, $all, 'plano_remodelacion_4', 'plano_remodelacion_4');
        $all = $this->storeFile($request, $all, 'plano_remodelacion_5', 'plano_remodelacion_5');
        $all = $this->storeFile($request, $all, 'plano_remodelacion_6', 'plano_remodelacion_6');
        $all = $this->storeFile($request, $all, 'plano_remodelacion_7', 'plano_remodelacion_7');
        $all = $this->storeFile($request, $all, 'plano_remodelacion_8', 'plano_remodelacion_8');
        $all = $this->storeFile($request, $all, 'plano_remodelacion_9', 'plano_remodelacion_9');
        $all = $this->storeFile($request, $all, 'plano_remodelacion_10', 'plano_remodelacion_10');

        $all = $this->storeFile($request, $all, 'plano_ampliacion_1', 'plano_ampliacion_1');
        $all = $this->storeFile($request, $all, 'plano_ampliacion_2', 'plano_ampliacion_2');
        $all = $this->storeFile($request, $all, 'plano_ampliacion_3', 'plano_ampliacion_3');
        $all = $this->storeFile($request, $all, 'plano_ampliacion_4', 'plano_ampliacion_4');
        $all = $this->storeFile($request, $all, 'plano_ampliacion_5', 'plano_ampliacion_5');
        $all = $this->storeFile($request, $all, 'plano_ampliacion_6', 'plano_ampliacion_6');
        $all = $this->storeFile($request, $all, 'plano_ampliacion_7', 'plano_ampliacion_7');
        $all = $this->storeFile($request, $all, 'plano_ampliacion_8', 'plano_ampliacion_8');
        $all = $this->storeFile($request, $all, 'plano_ampliacion_9', 'plano_ampliacion_9');
        $all = $this->storeFile($request, $all, 'plano_ampliacion_10', 'plano_ampliacion_10');

        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_1', 'plano_rutas_evacuacion_1');
        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_2', 'plano_rutas_evacuacion_2');
        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_3', 'plano_rutas_evacuacion_3');
        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_4', 'plano_rutas_evacuacion_4');
        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_5', 'plano_rutas_evacuacion_5');
        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_6', 'plano_rutas_evacuacion_6');
        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_7', 'plano_rutas_evacuacion_7');
        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_8', 'plano_rutas_evacuacion_8');
        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_9', 'plano_rutas_evacuacion_9');
        $all = $this->storeFile($request, $all, 'plano_rutas_evacuacion_10', 'plano_rutas_evacuacion_10');

        $all = $this->storeFile($request, $all, 'plano_senalizacion_1', 'plano_senalizacion_1');
        $all = $this->storeFile($request, $all, 'plano_senalizacion_2', 'plano_senalizacion_2');
        $all = $this->storeFile($request, $all, 'plano_senalizacion_3', 'plano_senalizacion_3');
        $all = $this->storeFile($request, $all, 'plano_senalizacion_4', 'plano_senalizacion_4');
        $all = $this->storeFile($request, $all, 'plano_senalizacion_5', 'plano_senalizacion_5');
        $all = $this->storeFile($request, $all, 'plano_senalizacion_6', 'plano_senalizacion_6');
        $all = $this->storeFile($request, $all, 'plano_senalizacion_7', 'plano_senalizacion_7');
        $all = $this->storeFile($request, $all, 'plano_senalizacion_8', 'plano_senalizacion_8');
        $all = $this->storeFile($request, $all, 'plano_senalizacion_9', 'plano_senalizacion_9');
        $all = $this->storeFile($request, $all, 'plano_senalizacion_10', 'plano_senalizacion_10');

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
<?php
namespace App\Http\Controllers\Api\DiligenciaVerificador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiligenciaVerificador\Diligencia;
use App\Repositories\DiligenciaVerificador\Interfaces\DiligenciaRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificarAnexo10;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\EstadoExpedienteAdhoc;
use Illuminate\Support\Facades\Storage;

class NotificacionController extends Controller
{
    private $repository;

    public function __construct( DiligenciaRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        return $this->repository->expedientesInformados($request);
    }
    /**
     * Notificar administrado sobre anexo10
     */
    public function update(Diligencia $diligencia)
    {
        $diligencia->entrega->expediente()->update(['estado_expediente_id' => EstadoExpedienteAdhoc::ADMINISTRADONOTIFICADO]);
        $adjuntos = [
           Storage::path("uploads/files/".$diligencia->anexo10 ),
        ];
        Mail::to(['mesadepartes@cenepred.gob.pe'])
        ->send(new NotificarAnexo10( $diligencia , $adjuntos ));

        return response()->json(['message' => "Se envio Notificacion al administrado" ], 201);
    }
    /**
     * expedientesNotificados
     * @return \Illuminate\Http\Response
     *
     */
    public function expedientesNotificados(Request $request)
    {
        if ( !empty($request->excel) ){
            return $this->repository->allToExport($request)
            ->downloadExcel(
                'EntregaExpediente_'.date('m-d-Y_hia').'.xlsx',
                $writerType = null,
                $headings = true
            );
        }
        //filtrar expedientes por adminstrado
        $request->request->add(['administrado_id' => Auth::id() ]);
        return $this->repository->expedientesInformados($request);
    }

}
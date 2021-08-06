<?php
namespace App\Http\Controllers\Api\DiligenciaVerificador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiligenciaVerificador\Diligencia;
use App\Repositories\DiligenciaVerificador\Interfaces\DiligenciaRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarAnexo10;
use Illuminate\Support\Facades\Auth;

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

        Mail::to(['mesadepartes@cenepred.gob.pe'])
        ->send(new EnviarAnexo10( $diligencia ));
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
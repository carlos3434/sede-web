<?php
namespace App\Http\Controllers\Api\RevisionExpediente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RevisionExpediente\Revision;
use App\Http\Requests\RevisionExpediente\RevisionRequest;
use App\Repositories\RevisionExpediente\Interfaces\RevisionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;
use App\Models\Settings\EstadoRevision;
use App\Models\Settings\EstadoExpedienteAdhoc;

class RevisionController extends Controller
{
    private $repository;

    public function __construct(RevisionRepositoryInterface $repository )
    {
        $this->repository = $repository;
/*
        $this->middleware(['role_or_permission:ADMINISTRADOR|REVISION_CREATE'])->only(['create','store']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|REVISION_INDEX'])->only('index');
        $this->middleware(['role_or_permission:ADMINISTRADOR|REVISION_EDIT'])->only(['edit','update']);
        $this->middleware(['role_or_permission:ADMINISTRADOR|REVISION_SHOW'])->only('show');
        $this->middleware(['role_or_permission:ADMINISTRADOR|REVISION_DESTROY'])->only('destroy');
*/
    }

    /**
     * muestra el listado de posstulaciones de la convocatoria actual
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->repository->all($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RevisionRequest $request)
    {
        $all = $request->all();
        //validar si el ultimo estado de revision es igual al que se intenta ingresar
        $revisionDB = $this->repository->getEstadoRevisionByArchivoId( $request->expedienteadhoc_archivo_id );

        if (isset($revisionDB->estado_revision_id) ) {
            if ($revisionDB->estado_revision_id == $request->estado_revision_id) {
                return response()->json(['message' => "Ya se encuentra registrado una revision para este archivo" ], 422);
            }
            //validar que no se registre revision excepto en los iguientes casos
            //observado => admitido  no
            if ( $revisionDB->estado_revision_id == EstadoRevision::OBSERVADO &&
                 $request->estado_revision_id == EstadoRevision::ADMITIDO ) {
                return response()->json(['message' => "No se puede admitir un archivo observado" ], 422);
            }
            //admitido  => observado no
            if ( $revisionDB->estado_revision_id == EstadoRevision::ADMITIDO &&
                 $request->estado_revision_id == EstadoRevision::OBSERVADO ) {
                return response()->json(['message' => "No se puede observar un archivo admitido" ], 422);
            }
            //admitido  => subsanado no
            if ( $revisionDB->estado_revision_id == EstadoRevision::ADMITIDO && 
                 $request->estado_revision_id == EstadoRevision::SUBSANADO ) {
                return response()->json(['message' => "No se puede subsanar un archivo admitido" ], 422);
            }
        }
        //fecha_revision
        $all['fecha_revision'] = $request->get('fecha_revision',date("Y-m-d H:i:s") );
        $revision = $this->repository->create( $all );
        //si se registra una observacion el estado del expediente sera Observado
        if ($request->estado_revision_id == EstadoRevision::OBSERVADO) {
            $revision->expedienteAdhocArchivos->expedienteAdhoc()->update([
                'estado_expediente_id' => EstadoExpedienteAdhoc::OBSERVADO
            ]);
        }
        
        return response()->json($revision, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show(Revision $revision)
    {
        return $this->repository->getOne($revision);
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revision  $revision
     * @return \Illuminate\Http\Response
     */
    /*public function update(RevisionUpdateRequest $request, Revision $revision)
    {
        $all = $request->all();
        $all = $this->storeFile($request, $all, 'Revision', 'archivo_titulo');
        $revision = $this->repository->updateOne($all, $revision);
        return response()->json($revision, 200);
    }*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Revision  $revision
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Revision $revision)
    {
        $this->repository->deleteOne($revision);
        return response()->json(null, 204);
    }*/

}
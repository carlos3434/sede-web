<?php
namespace App\Http\Controllers\Api\RevisionExpediente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RevisionExpediente\Revision;
use App\Http\Requests\RevisionExpediente\RevisionRequest;
use App\Repositories\RevisionExpediente\Interfaces\RevisionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;

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
        //$all['usuario_id'] = Auth::id();
        //$all = $this->storeFile($request, $all, 'Revision', 'archivo_titulo');
        $revision = $this->repository->create( $all );
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
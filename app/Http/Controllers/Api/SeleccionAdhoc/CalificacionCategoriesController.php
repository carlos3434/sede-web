<?php
namespace App\Http\Controllers\Api\SeleccionAdhoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SeleccionAdhoc\Calificacion;
use App\Repositories\SeleccionAdhoc\Interfaces\CalificacionRepositoryInterface;
use App\Http\Resources\RegistroAdhoc\Formacion\FormacionCollection;
use App\Http\Resources\RegistroAdhoc\Capacitacion\CapacitacionCollection;
use App\Http\Resources\RegistroAdhoc\ExperienciaGeneral\ExperienciaGeneralCollection;
use App\Http\Resources\RegistroAdhoc\ExperienciaInspector\ExperienciaInspectorCollection;
use App\Http\Resources\RegistroAdhoc\VerificacionRealizada\VerificacionRealizadaCollection;

class CalificacionCategoriesController extends Controller
{
    private $repository;

    public function __construct( CalificacionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        //$this->middleware(['role_or_permission:ADMINISTRADOR|POSTULACION_SHOW'])->only('index');
        //$this->middleware(['role_or_permission:ADMINISTRADOR|POSTULACION_CREATE'])->only('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formaciones(Calificacion $calificacion)
    {
        return new FormacionCollection( $calificacion->user->formaciones );
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function capacitaciones(Calificacion $calificacion)
    {
        return new CapacitacionCollection( $calificacion->user->capacitaciones );
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function experienciasGenerales(Calificacion $calificacion)
    {
        return new ExperienciaGeneralCollection( $calificacion->user->experienciasGenerales );
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function experienciasInspectores(Calificacion $calificacion)
    {
        return new ExperienciaInspectorCollection( $calificacion->user->experienciasInspectores );
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verificacionesRealizadas(Calificacion $calificacion)
    {
        return new VerificacionRealizadaCollection( $calificacion->user->verificacionesRealizadas );
    }

}
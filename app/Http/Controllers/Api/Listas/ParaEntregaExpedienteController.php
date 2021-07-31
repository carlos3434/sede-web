<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\Listas\ParaEntregaExpediente\AcreditacionCollection;
use App\Http\Resources\Listas\ParaEntregaExpediente\EstadoExpedienteAdhocCollection;
use App\Http\Resources\Listas\ParaEntregaExpediente\EstadoRevisionCollection;

use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;

use App\Models\SeleccionAdhoc\Acreditacion;
use App\Models\Settings\EstadoExpedienteAdhoc;
use App\Models\Settings\EstadoRevision;

class ParaEntregaExpedienteController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $convocatoriaActualId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false;

        $response = [
            'hay_convocatoria_actual' =>  (isset( Convocatoria::GetActual()->id )) ? true : false,
            //'esta_postulando' => Auth::user()->estaPostulando(),

            'acreditaciones' => new AcreditacionCollection(Acreditacion::all()),//Acreditacion
            'estado_expediente' => new EstadoExpedienteAdhocCollection(EstadoExpedienteAdhoc::all()),//EstadoExpedienteAdhoc
            'estado_revision' => new EstadoRevisionCollection(EstadoRevision::whereIn('id',[EstadoRevision::OBSERVADO, EstadoRevision::ADMITIDO])->get()),//EstadoRevision

        ];
        return response()->json($response, 200);
    }
}

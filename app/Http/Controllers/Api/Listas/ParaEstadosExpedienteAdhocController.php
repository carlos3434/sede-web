<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\Institucion;
use App\Http\Resources\Listas\Commons\InstitucionCollection;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc;
use App\Http\Resources\Listas\ParaEstadosExpedienteAdhoc\ParaSolicitarExpedienteCollection;

class ParaEstadosExpedienteAdhocController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['role_or_permission:ADMINISTRADOR|VERIFICACION_REALIZADA_INDEX'])->only('index');
    }

    public function hojaTramite()
    {
        $response = [
            //'esta_postulando' => Auth::user()->estaPostulando(),
            'expedientes' => new ParaSolicitarExpedienteCollection(
                ExpedienteAdhoc::where('usuario_id', Auth::id() )
                ->where('estado_expediente_id',1)//CREADO
                ->orderBy('nombre_comercial', 'asc')
                ->get()
            )
        ];
        return response()->json($response, 200);
    }
    public function verificacion()
    {
        $response = [
            //'esta_postulando' => Auth::user()->estaPostulando(),
            'expedientes' => new ParaSolicitarExpedienteCollection(
                ExpedienteAdhoc::where('usuario_id', Auth::id() )
                ->where('estado_expediente_id',2)//Hoja tramite
                ->orderBy('nombre_comercial', 'asc')
                ->get()
            )
        ];
        return response()->json($response, 200);
    }
}

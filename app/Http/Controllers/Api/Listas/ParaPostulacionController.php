<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\Institucion;
use App\Http\Resources\Listas\ParaPostulacion\SedeRegistralCollection;
use App\Models\Settings\SedeRegistral;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;

class ParaPostulacionController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['role_or_permission:ADMINISTRADOR|POSTULACION_INDEX'])->only('index');
    }

    public function index()
    {
        $response = [
            'hay_convocatoria_actual' => (bool) Convocatoria::GetActual(),
            'esta_postulando' => Auth::user()->estaPostulando(),
            'sedes_registrales' => new SedeRegistralCollection(SedeRegistral::all())
        ];
        return response()->json($response, 200);
    }
}

<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\Institucion;
use App\Http\Resources\Listas\ParaPostulacion\SedeRegistralCollection;
use App\Models\Settings\SedeRegistral;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;
use App\Http\Resources\Listas\Commons\ConvocatoriaCollection;

class ParaCalificacionController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $response = [
            'hay_convocatoria_actual' =>  (isset( Convocatoria::GetActual()->id )) ? true : false,
            'esta_postulando' => Auth::user()->estaPostulando(),
            'esta_acreditado' => Auth::user()->estaAcreditado(),
            'sedes_registrales' => new SedeRegistralCollection(SedeRegistral::all()),
            'convocatorias' => new ConvocatoriaCollection(Convocatoria::all())
        ];
        return response()->json($response, 200);
    }
}

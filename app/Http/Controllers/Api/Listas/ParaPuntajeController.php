<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\Institucion;
use App\Http\Resources\Listas\ParaPostulacion\SedeRegistralCollection;
use App\Models\Settings\SedeRegistral;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;
use App\Models\SeleccionAdhoc\Categoria;

class ParaPuntajeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $convocatoriaActualId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false;

        $response = [
            'hay_convocatoria_actual' =>  (isset( Convocatoria::GetActual()->id )) ? true : false,
            'esta_postulando' => Auth::user()->estaPostulando(),
            'categorias_items' => 
            Categoria::with(['items' => function($q) use($convocatoriaActualId) {
                $q->where('convocatoria_id', $convocatoriaActualId);
            }])->get()
        ];
        return response()->json($response, 200);
    }
}

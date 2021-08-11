<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\Institucion;
use App\Models\Settings\Grado;
use App\Http\Resources\Listas\ParaFormacion\GradoCollection;
use App\Http\Resources\Listas\Commons\InstitucionCollection;
use Illuminate\Support\Facades\Auth;


class ParaFormacionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_INDEX'])->only('index');
    }

    public function index()
    {
        $response = [
            'esta_postulando' => Auth::user()->estaPostulando(),
            'esta_acreditado' => Auth::user()->estaAcreditado(),
            'grado_academicos' => new GradoCollection(Grado::all()),
            'institutiones' => new InstitucionCollection(
                Institucion::where('tipo_institucion_id', Institucion::INSTITUCION_ACADEMICA )
                ->orderBy('nombre', 'asc')
                ->get()
            )
        ];
        return response()->json($response, 200);
    }
}

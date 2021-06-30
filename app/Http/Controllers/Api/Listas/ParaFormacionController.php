<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\Institucion;
use App\Models\Settings\Grado;
use App\Http\Resources\Listas\ParaFormacion\GradoCollection;
use App\Http\Resources\Listas\ParaFormacion\InstitucionCollection;


class ParaFormacionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_INDEX'])->only('index');
    }

    public function index()
    {
        $response = [
            'esta_postulando' => false,
            'grado_academicos' => new GradoCollection(Grado::all()),
            'institutiones' => new InstitucionCollection(
                Institucion::where('tipo_institucion_id', Institucion::INSTITUCION_ACADEMICA )
                ->get()
            )
        ];
        return response()->json($response, 200);
    }
}
/*
        $convocatoriaActual = Configuracion::where('nombre', 'CONVOCATORIA_ACTUAL')->take(1)->get()[0]->valor;
        $calificacionInicial= Calificacion::where('usuario_id',$this->id)->where('convocatoria_id',$convocatoriaActual)->count();
        return ($calificacionInicial >0);*/
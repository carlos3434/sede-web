<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\Institucion;
use App\Models\Settings\TipoCapacitacion;
use App\Http\Resources\Listas\ParaCapacitacion\TipoCapacitacionCollection;
use App\Http\Resources\Listas\Commons\InstitucionCollection;


class ParaCapacitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:ADMINISTRADOR|CAPACITACION_INDEX'])->only('index');
    }

    public function index()
    {
        $response = [
            'tipo_capacitacion' => new TipoCapacitacionCollection(TipoCapacitacion::all()),
            'institutiones' => new InstitucionCollection(
                Institucion::where('tipo_institucion_id', Institucion::INSTITUCION_ACADEMICA )
                ->orderBy('nombre', 'asc')
                ->get()
            )
        ];
        return response()->json($response, 200);
    }
}

<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\Institucion;
use App\Http\Resources\Listas\Commons\InstitucionCollection;


class ParaExperienciaGeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:ADMINISTRADOR|EXPERIENCIA_INDEX'])->only('index');
    }

    public function index()
    {
        $response = [
            'institutiones' => new InstitucionCollection(
                Institucion::where('tipo_institucion_id', Institucion::GOBIERNO_LOCAL )
                ->orderBy('nombre', 'asc')
                ->get()
            )
        ];
        return response()->json($response, 200);
    }
}

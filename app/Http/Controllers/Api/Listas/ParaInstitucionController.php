<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\TipoInstitucion;
use App\Http\Resources\Listas\Commons\TipoInstitucionCollection;

class ParaInstitucionController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_INDEX'])->only('index');
    }

    public function index()
    {
        $response = [
            'tipo_institution' => new TipoInstitucionCollection(TipoInstitucion::all()),
        ];
        return response()->json($response, 200);
    }
}

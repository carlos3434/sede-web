<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\TipoInstitucion;
use App\Http\Resources\Listas\Commons\TipoInstitucionCollection;
use App\Models\Settings\TipoDocumento;

class ParaUsuarioController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['role_or_permission:ADMINISTRADOR|FORMACION_INDEX'])->only('index');
    }

    public function index()
    {
        $sexo[] = ['id'=>0,'nombre'=>'Masculino'];
        $sexo[] = ['id'=>1,'nombre'=>'Femenino'];
        $response = [
            'tiposDocumentos' => TipoDocumento::all(),
            'sexo' => $sexo,
        ];
        return response()->json($response, 200);
    }
}

<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\TipoDocumento;
use App\Models\Settings\Pais;
use App\Models\Settings\Departamento;
use App\Models\Settings\Provincia;
use App\Models\Settings\Distrito;
use Spatie\Permission\Models\Role;

class ParaRegistroController extends Controller
{

    public function index()
    {
        $sexo[] = ['id'=>0,'nombre'=>'Masculino'];
        $sexo[] = ['id'=>1,'nombre'=>'Femenino'];
        $response = [
            'tiposDocumentos' => TipoDocumento::all(),
            'roles' => Role::whereIn('name',['USUARIO_ADHOC','USUARIO_ADMINISTRADO'])->get(),
            'paises' => Pais::all(),
            'sexo' => $sexo,
            'departamentos' => Departamento::all(),
            'provincias' => Provincia::all(),
            'distritos' => Distrito::all(),
        ];
        return response()->json($response, 200);
    }
}
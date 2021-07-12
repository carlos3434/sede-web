<?php

namespace App\Http\Controllers\Api\Listas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Settings\Institucion;
use App\Http\Resources\Listas\ParaPostulacion\SedeRegistralCollection;
use App\Http\Resources\Listas\ParaPostulacion\CategoriaItemCollection;
use App\Http\Resources\SeleccionAdhoc\Item\ItemCollection;
use App\Models\Settings\SedeRegistral;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Convocatoria;
use App\Models\SeleccionAdhoc\Categoria;
use App\Models\SeleccionAdhoc\Item;

class ParaPuntajeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $convocatoriaActualId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false;
        $categoria = Categoria::from('categorias as c')->select('i.*')
                ->join('items as i','c.id','=','i.categoria_id')->where('convocatoria_id',$convocatoriaActualId);

        $response = [
            'hay_convocatoria_actual' =>  (isset( Convocatoria::GetActual()->id )) ? true : false,
            'esta_postulando' => Auth::user()->estaPostulando(),

            'formaciones' => new ItemCollection( 
                $categoria->where('c.id',1)
                ->get()
            ),
            'capacitaciones' => new ItemCollection( 
                $categoria->where('c.id',2)
                ->get()
            ),
            'experiencias_generales' => new ItemCollection( 
                $categoria->where('c.id',3)
                ->get()
            ),
            'experiencias_inspector' => new ItemCollection( 
                $categoria->where('c.id',4)
                ->get()
            ),
            'verificaciones_realizadas' => new ItemCollection( 
                $categoria->where('c.id',5)
                ->get()
            ),

        ];
        return response()->json($response, 200);
    }
}

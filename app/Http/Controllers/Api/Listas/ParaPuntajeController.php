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
        $categoria1 = Categoria::from('categorias as c')->select('i.*')
                ->join('items as i','c.id','=','i.categoria_id')
                ->where('i.activo',true)
                ->where('c.id',1)
                ->orderBy('i.puntaje','ASC')
                ->get();
        $categoria2 = Categoria::from('categorias as c')->select('i.*')
                ->join('items as i','c.id','=','i.categoria_id')
                ->where('i.activo',true)
                ->where('c.id',2)
                ->orderBy('i.puntaje','ASC')
                ->get();
        $categoria3 = Categoria::from('categorias as c')->select('i.*')
                ->join('items as i','c.id','=','i.categoria_id')
                ->where('i.activo',true)
                ->where('c.id',3)
                ->orderBy('i.puntaje','ASC')
                ->get();
        $categoria4 = Categoria::from('categorias as c')->select('i.*')
                ->join('items as i','c.id','=','i.categoria_id')
                ->where('i.activo',true)
                ->where('c.id',4)
                ->orderBy('i.puntaje','ASC')
                ->get();
        $categoria5 = Categoria::from('categorias as c')->select('i.*')
                ->join('items as i','c.id','=','i.categoria_id')
                ->where('i.activo',true)
                ->where('c.id',5)
                ->orderBy('i.puntaje','ASC')
                ->get();

        $response = [
            'hay_convocatoria_actual' =>  (isset( Convocatoria::GetActual()->id )) ? true : false,
            'esta_postulando' => Auth::user()->estaPostulando(),
            'esta_acreditado' => Auth::user()->estaAcreditado(),

            'formaciones' => new ItemCollection( $categoria1 ),
            'capacitaciones' => new ItemCollection( $categoria2 ),
            'experiencias_generales' => new ItemCollection( $categoria3 ),
            'experiencias_inspector' => new ItemCollection( $categoria4 ),
            'verificaciones_realizadas' => new ItemCollection( $categoria5 ),

        ];
        return response()->json($response, 200);
    }
}

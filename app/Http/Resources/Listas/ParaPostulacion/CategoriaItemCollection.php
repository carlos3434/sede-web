<?php

namespace App\Http\Resources\Listas\ParaPostulacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Models\Settings\Convocatoria;
use App\Http\Resources\SeleccionAdhoc\Item\ItemCollection;
class CategoriaItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $convocatoriaActualId = (isset( Convocatoria::GetActual()->id )) ? Convocatoria::GetActual()->id : false;

        return $this->collection->transform(function ($categoria) use ($convocatoriaActualId) {
            return [
                
               // 'id' => $categoria->id,
              //  'nombre' => $categoria->nombre,

                $categoria->slug => new ItemCollection( 
                    $categoria->items->where('convocatoria_id',$convocatoriaActualId)
                ),

            ];
        });
    }
}

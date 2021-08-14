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
        return $this->collection->transform(function ($categoria) {
            return [
                $categoria->slug => new ItemCollection(  $categoria->items )
            ];
        });
    }
}

<?php

namespace App\Http\Resources\Listas\Commons;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TipoInstitucionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($tipoInstitucion) {
            return [
                'id' => $tipoInstitucion->id,
                'nombre' => $tipoInstitucion->nombre
            ];
        });
    }
}

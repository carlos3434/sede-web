<?php

namespace App\Http\Resources\Listas\Commons;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InstitucionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($institucion) {
            return [
                'id' => $institucion->id,
                'nombre' => $institucion->nombre
            ];
        });
    }
}

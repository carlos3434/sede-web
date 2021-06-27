<?php

namespace App\Http\Resources\Settings\Institucion;

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
        return $this->collection->transform(function ($Institucion) {
            return new InstitucionResource($Institucion);
        });
    }
}

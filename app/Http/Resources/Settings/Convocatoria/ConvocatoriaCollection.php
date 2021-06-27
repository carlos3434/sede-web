<?php

namespace App\Http\Resources\Settings\Convocatoria;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ConvocatoriaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($Convocatoria) {
            return new ConvocatoriaResource($Convocatoria);
        });
    }
}

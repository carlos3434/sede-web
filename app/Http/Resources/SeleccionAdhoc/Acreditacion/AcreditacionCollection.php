<?php

namespace App\Http\Resources\SeleccionAdhoc\Acreditacion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AcreditacionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($acreditacion) {
            return new AcreditacionResource($acreditacion);
        });
    }
}

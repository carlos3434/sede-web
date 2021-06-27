<?php

namespace App\Http\Resources\Settings\Grado;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GradoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($Grado) {
            return new GradoResource($Grado);
        });
    }
}

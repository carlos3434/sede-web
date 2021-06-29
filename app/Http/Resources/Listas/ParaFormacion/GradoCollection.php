<?php

namespace App\Http\Resources\Listas\ParaFormacion;

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
            return [
                'id' => $Grado->id,
                'nombre' => $Grado->nombre,
            ]; //return new GradoResource($Grado);
        });
    }
}

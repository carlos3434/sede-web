<?php

namespace App\Http\Resources\Settings\TipoDocumento;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TipoDocumentoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($TipoDocumento) {
            return new TipoDocumentoResource($TipoDocumento);
        });
    }
}

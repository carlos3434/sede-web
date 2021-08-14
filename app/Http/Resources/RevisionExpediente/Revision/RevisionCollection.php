<?php

namespace App\Http\Resources\RevisionExpediente\Revision;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RevisionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($Capacitacion) {
            return new RevisionResource($Capacitacion);
        });
    }
}

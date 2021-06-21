<?php

namespace App\Http\Resources\Auth\Role;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($role) {
            return new RoleResource($role);
        });
        //return parent::toArray($request);
    }
}

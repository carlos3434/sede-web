<?php

namespace App\Http\Resources\Auth\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Auth\Role\RoleCollection;
class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'special' => $this->special,
            'created_at' => $this->created_at->toDateTimeString(),
            'roles' => new RoleCollection($this->roles)
        ];
    }
}

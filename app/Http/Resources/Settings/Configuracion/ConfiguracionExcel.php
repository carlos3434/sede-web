<?php

namespace App\Http\Resources\Settings\Configuracion;

use Illuminate\Http\Resources\Json\JsonResource;


class ConfiguracionExcel extends JsonResource
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

            'id'                   => $this->id,
            'nombre'               => $this->nombre,
            'created_at'           => $this->created_at->toDateTimeString(),
            'updated_at'           => $this->updated_at->toDateTimeString(),


        ];
    }
}

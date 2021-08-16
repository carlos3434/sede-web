<?php

namespace App\Http\Resources\SeleccionAdhoc\Acreditacion;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AcreditacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                     => $this->id,
            'fecha_inicio'           => Carbon::parse($this->fecha_inicio)->toDateString(),
            'fecha_fin'              => Carbon::parse($this->fecha_fin)->toDateString(),
            'calificacion_id'        => $this->calificacion_id,
            'calificacion_fecha'     => $this->calificacion->fecha,

            'created_at'             => $this->created_at->toDateTimeString(),
            'updated_at'             => $this->updated_at->toDateTimeString(),
        ];
    }
}
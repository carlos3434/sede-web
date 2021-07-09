<?php

namespace App\Http\Resources\RegistroAdhoc\Postulacion;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PostulacionResource extends JsonResource
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
            'fecha'                  => Carbon::parse($this->fecha)->toDateString(),
            'usuario_id'             => $this->usuario_id,
            'convocatoria_id'        => $this->convocatoria_id,
            'convocatoria_nombre'    => $this->convocatoria->nombre,
            'sede_registral_id'      => $this->sede_registral_id,
            'sede_registral_nombre'  => $this->sedeRegistral->nombre,

            'created_at'             => $this->created_at->toDateTimeString(),
            'updated_at'             => $this->updated_at->toDateTimeString(),
        ];
    }
}
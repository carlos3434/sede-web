<?php

namespace App\Http\Resources\RevisionExpediente\Revision;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class RevisionResource extends JsonResource
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
            'id' => $this->id,
            'observacion' => $this->observacion,
            'fecha_revision' => $this->fecha_revision,
            'fecha_subsanacion' => $this->fecha_subsanacion,
            'estado_revision_id' => $this->estado_revision_id,
            'expedienteadhoc_archivo_id' => $this->expedienteadhoc_archivo_id,

            'created_at'             => $this->created_at->toDateTimeString(),
            'updated_at'             => $this->updated_at->toDateTimeString(),
        ];
    }
}
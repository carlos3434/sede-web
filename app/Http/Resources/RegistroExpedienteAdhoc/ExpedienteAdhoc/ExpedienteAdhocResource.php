<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhocArchivo\ExpedienteAdhocArchivoCollection;
use App\Http\Resources\RegistroExpedienteAdhoc\Archivo\ArchivoParentCollection;

class ExpedienteAdhocResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
    }
}
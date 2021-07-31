<?php

namespace App\Http\Resources\RevisionExpediente\EntregaExpediente;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EntregaExpedienteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform( function ($expedienteAdhoc) {

            return [
                "id" => $expedienteAdhoc->id,
                "nombre_comercial" => $expedienteAdhoc->nombre_comercial,
                "direccion" => $expedienteAdhoc->direccion,
                "estado_expediente" => $expedienteAdhoc->estado_expediente,
                "estado_id" => $expedienteAdhoc->estado_id,
                "fecha_entrega" => $expedienteAdhoc->fecha_entrega,
                "administrado_nombres" => $expedienteAdhoc->administrado_nombres,
                "administrado_apellido_paterno" => $expedienteAdhoc->administrado_apellido_paterno,
                "administrado_apellido_materno" => $expedienteAdhoc->administrado_apellido_materno,
                "administrado_id" => $expedienteAdhoc->administrado_id,
                "adhoc_nombres" => $expedienteAdhoc->adhoc_nombres,
                "adhoc_apellido_paterno" => $expedienteAdhoc->adhoc_apellido_paterno,
                "adhoc_apellido_materno" => $expedienteAdhoc->adhoc_apellido_materno,
                "adhoc_id" => $expedienteAdhoc->adhoc_id,
                "fecha_solicitud_ht" => $expedienteAdhoc->fecha_solicitud_ht,
                "fecha_ingreso_ht" => $expedienteAdhoc->fecha_ingreso_ht,
                "distrito_id" => $expedienteAdhoc->distrito_id,
                "provincia_id" => $expedienteAdhoc->provincia_id,
                "departamento_id" => $expedienteAdhoc->departamento_id,
               // "ubigeo" => $expedienteAdhoc->ubigeo,
                "departamento_nombre" => $expedienteAdhoc->departamento_nombre,
                "cenepred_nombres" => $expedienteAdhoc->cenepred_nombres,
                "cenepred_apellido_paterno" => $expedienteAdhoc->cenepred_apellido_paterno,
                "cenepred_apellido_materno" => $expedienteAdhoc->cenepred_apellido_materno,
                "cenepred_id" => $expedienteAdhoc->cenepred_id,
            ];
        });
    }
}

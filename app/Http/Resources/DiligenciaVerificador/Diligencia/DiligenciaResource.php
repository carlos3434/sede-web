<?php

namespace App\Http\Resources\DiligenciaVerificador\Diligencia;

use Illuminate\Http\Resources\Json\JsonResource;

class DiligenciaResource extends JsonResource
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

            'nombre_comercial' => $this->nombre_comercial,
            'direccion' => $this->direccion,
            'estado_expediente' => $this->estado_expediente,
            'estado_id' => $this->estado_id,
            'fecha_entrega' => $this->fecha_entrega,
            'administrado_nombres' => $this->administrado_nombres,
            'administrado_apellido_paterno' => $this->administrado_apellido_paterno,
            'administrado_apellido_materno' => $this->administrado_apellido_materno,
            'administrado_id' => $this->administrado_id,
            'adhoc_nombres' => $this->adhoc_nombres,
            'adhoc_apellido_paterno' => $this->adhoc_apellido_paterno,
            'adhoc_apellido_materno' => $this->adhoc_apellido_materno,
            'adhoc_id' => $this->adhoc_id,
            'fecha_solicitud_ht' => $this->fecha_solicitud_ht,
            'fecha_ingreso_ht' => $this->fecha_ingreso_ht,
            'distrito_id' => $this->distrito_id,
            'ubigeo' => $this->ubigeo,
            'provincia_id' => $this->provincia_id,
            'departamento_id' => $this->departamento_id,
            'departamento_nombre' => $this->departamento_nombre,
            'cenepred_nombres' => $this->cenepred_nombres,
            'cenepred_apellido_paterno' => $this->cenepred_apellido_paterno,
            'cenepred_apellido_materno' => $this->cenepred_apellido_materno,
            'cenepred_id' => $this->cenepred_id,
            'fecha_diligencia' => $this->fecha_diligencia,
            'anexo8' => $this->anexo8,
            'anexo9' => $this->anexo9,
            'anexo10' => $this->anexo10,

        ];
    }
}
<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhocArchivo;

//use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpedienteAdhocArchivoResource extends JsonResource
{
    private $result;
    public function __construct($result)
    {
        $this->result = $result;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->result[0]->id,
            'nombre_comercial' => $this->result[0]->nombre_comercial,
            'direccion' => $this->result[0]->direccion,
            'area' => $this->result[0]->area,
            'monto' => $this->result[0]->monto,
            'nombre_banco' => $this->result[0]->nombre_banco,
            'numero_operacion' => $this->result[0]->numero_operacion,
            'fecha_operacion' => $this->result[0]->fecha_operacion,
            'agencia' => $this->result[0]->agencia,
            'distrito_id' => $this->result[0]->distrito_id,
            'expedienteadhoc_archivo' => new ExpedienteAdhocArchivoCollection( $this->result ),
        ];
    }
}

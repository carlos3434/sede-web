<?php

namespace App\Http\Resources\RevisionExpediente\EntregaExpediente;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class EntregaExpedienteResource extends JsonResource
{
    private $result;
    private $revisiones;
    public function __construct($result, $revisiones)
    {
        $this->result = $result;
        $this->revisiones = $revisiones;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (!isset($this->result[0])) {
            return [];
        }
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
            'recibo_pago' => $this->result[0]->recibo_pago,
            'archivo_solicitud_ht' => $this->result[0]->archivo_solicitud_ht,
            'estado_expediente_id' => $this->result[0]->estado_expediente_id,
            'estado_expediente_nombre' => $this->result[0]->estado_expediente_nombre,
            'adhoc_nombres' => $this->result[0]->adhoc_nombres,
            'adhoc_apellido_paterno' => $this->result[0]->adhoc_apellido_paterno,
            'adhoc_apellido_materno' => $this->result[0]->adhoc_apellido_materno,
            'adhoc' => $this->result[0]->adhoc_nombres.' '.$this->result[0]->adhoc_apellido_paterno,

            'entregas_expediente_id' => $this->result[0]->entregas_expediente_id,
            'fecha_entrega' => $this->result[0]->fecha_entrega,
            'fecha_recepcion' => $this->result[0]->fecha_recepcion,
            'cenepred_nombres' => $this->result[0]->cenepred_nombres,
            'cenepred_apellido_paterno' => $this->result[0]->cenepred_apellido_paterno,
            'cenepred_apellido_materno' => $this->result[0]->cenepred_apellido_materno,
            //agregar la observacion
            //agregar cuantos son observados y cuantos admitidos
            'revisiones' => $this->revisiones,
            'expedienteadhoc_archivo' => new EntregaExpedienteCollection( $this->result ),
        ];
    }
}
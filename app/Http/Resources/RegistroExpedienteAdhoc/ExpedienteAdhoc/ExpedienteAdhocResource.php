<?php

namespace App\Http\Resources\RegistroExpedienteAdhoc\ExpedienteAdhoc;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,

            'nombre_comercial' => $this->nombre_comercial,
            'direccion' => $this->direccion,
            'area' => $this->area,

            'Archivos'                   => $this->archivos,
            //Documentos principales
            'Documentos principales' => [
                'carta_poder_simple' => $this->carta_poder_simple,
                'copia_vigencia_poder' => $this->copia_vigencia_poder,
                'copia_partida_registral' => $this->copia_partida_registral,
                'copia_dni_propietario' => $this->copia_dni_propietario,
                'recibo_pago' => $this->recibo_pago,
                'copia_formulario_for' => $this->copia_formulario_for,
                'informe_tecnico_verificador_responsable' => $this->informe_tecnico_verificador_responsable,
                'esquela_observacion_sunarp' => $this->esquela_observacion_sunarp,
                'plano_ubicacion_01' => $this->plano_ubicacion_01,
                'plano_ubicacion_02' => $this->plano_ubicacion_02,
                'memoria_descriptiva_seguridad' => $this->memoria_descriptiva_seguridad,
                'certificado_pozo_tierra' => $this->certificado_pozo_tierra,
                'certificado_laminados' => $this->certificado_laminados,
                'certificado_sistema_electrico' => $this->certificado_sistema_electrico,
            ],
            //Planos de arquitectura
            'Planos de arquitectura' => [
                'plano_arquitectura_1' => $this->plano_arquitectura_1,
                'plano_arquitectura_2' => $this->plano_arquitectura_2,
                'plano_arquitectura_3' => $this->plano_arquitectura_3,
                'plano_arquitectura_4' => $this->plano_arquitectura_4,
                'plano_arquitectura_5' => $this->plano_arquitectura_5,
                'plano_arquitectura_6' => $this->plano_arquitectura_6,
                'plano_arquitectura_7' => $this->plano_arquitectura_7,
                'plano_arquitectura_8' => $this->plano_arquitectura_8,
                'plano_arquitectura_9' => $this->plano_arquitectura_9,
                'plano_arquitectura_10' => $this->plano_arquitectura_10,
            ],
            //Planos de fábrica inscrita
            'Planos de fábrica inscrita' => [
                'plano_fabrica_1' => $this->plano_fabrica_1,
                'plano_fabrica_2' => $this->plano_fabrica_2,
                'plano_fabrica_3' => $this->plano_fabrica_3,
                'plano_fabrica_4' => $this->plano_fabrica_4,
                'plano_fabrica_5' => $this->plano_fabrica_5,
                'plano_fabrica_6' => $this->plano_fabrica_6,
                'plano_fabrica_7' => $this->plano_fabrica_7,
                'plano_fabrica_8' => $this->plano_fabrica_8,
                'plano_fabrica_9' => $this->plano_fabrica_9,
                'plano_fabrica_10' => $this->plano_fabrica_10,
            ],

            //Planos de remodelación
            'Planos de remodelación' => [
                'plano_remodelacion_1' => $this->plano_remodelacion_1,
                'plano_remodelacion_2' => $this->plano_remodelacion_2,
                'plano_remodelacion_3' => $this->plano_remodelacion_3,
                'plano_remodelacion_4' => $this->plano_remodelacion_4,
                'plano_remodelacion_5' => $this->plano_remodelacion_5,
                'plano_remodelacion_6' => $this->plano_remodelacion_6,
                'plano_remodelacion_7' => $this->plano_remodelacion_7,
                'plano_remodelacion_8' => $this->plano_remodelacion_8,
                'plano_remodelacion_9' => $this->plano_remodelacion_9,
                'plano_remodelacion_10' => $this->plano_remodelacion_10,
            ],

            //Planos de ampliación
            'Planos de ampliación' => [
                'plano_ampliacion_1' => $this->plano_ampliacion_1,
                'plano_ampliacion_2' => $this->plano_ampliacion_2,
                'plano_ampliacion_3' => $this->plano_ampliacion_3,
                'plano_ampliacion_4' => $this->plano_ampliacion_4,
                'plano_ampliacion_5' => $this->plano_ampliacion_5,
                'plano_ampliacion_6' => $this->plano_ampliacion_6,
                'plano_ampliacion_7' => $this->plano_ampliacion_7,
                'plano_ampliacion_8' => $this->plano_ampliacion_8,
                'plano_ampliacion_9' => $this->plano_ampliacion_9,
                'plano_ampliacion_10' => $this->plano_ampliacion_10,
            ],

            //Planos de rutas de evacuación
            'Planos de rutas de evacuación' => [
                'plano_rutas_evacuacion_1' => $this->plano_rutas_evacuacion_1,
                'plano_rutas_evacuacion_2' => $this->plano_rutas_evacuacion_2,
                'plano_rutas_evacuacion_3' => $this->plano_rutas_evacuacion_3,
                'plano_rutas_evacuacion_4' => $this->plano_rutas_evacuacion_4,
                'plano_rutas_evacuacion_5' => $this->plano_rutas_evacuacion_5,
                'plano_rutas_evacuacion_6' => $this->plano_rutas_evacuacion_6,
                'plano_rutas_evacuacion_7' => $this->plano_rutas_evacuacion_7,
                'plano_rutas_evacuacion_8' => $this->plano_rutas_evacuacion_8,
                'plano_rutas_evacuacion_9' => $this->plano_rutas_evacuacion_9,
                'plano_rutas_evacuacion_10' => $this->plano_rutas_evacuacion_10,
            ],

            //Planos de señalización
            'Planos de señalización' => [
                'plano_senalizacion_1' => $this->plano_senalizacion_1,
                'plano_senalizacion_2' => $this->plano_senalizacion_2,
                'plano_senalizacion_3' => $this->plano_senalizacion_3,
                'plano_senalizacion_4' => $this->plano_senalizacion_4,
                'plano_senalizacion_5' => $this->plano_senalizacion_5,
                'plano_senalizacion_6' => $this->plano_senalizacion_6,
                'plano_senalizacion_7' => $this->plano_senalizacion_7,
                'plano_senalizacion_8' => $this->plano_senalizacion_8,
                'plano_senalizacion_9' => $this->plano_senalizacion_9,
                'plano_senalizacion_10' => $this->plano_senalizacion_10,
            ],

            'observaciones' => $this->observaciones,
            'x' => $this->x,
            'y' => $this->y,
            'fecha_solicitud_ht' => $this->fecha_solicitud_ht,
            'fecha_ingreso_ht' => $this->fecha_ingreso_ht,
            'ht' => $this->ht,

            'usuario_id' => $this->usuario_id,
            'estado_expediente_id' => $this->estado_expediente_id,
            'usuario_revisor_id' => $this->usuario_revisor_id,

            'created_at'       => $this->created_at->toDateTimeString(),
            'updated_at'       => $this->updated_at->toDateTimeString(),
        ];
    }
}
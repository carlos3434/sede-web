<?php

namespace App\Http\Resources\Auth\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,

            'nombres' => $this->nombres,
            'email' => $this->email,
            'numero_documento' => $this->numero_documento,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'sexo' => $this->sexo,
            'telefono_fijo' => $this->telefono_fijo,
            'celular' => $this->celular,
            'direccion' => $this->direccion,
            'colegio_profesional' => $this->colegio_profesional,
            'numero_colegiatura' => $this->numero_colegiatura,
            'esta_habilitado' => $this->esta_habilitado,
            'tipo_documento_id' => $this->tipo_documento_id,
            'estado_civil_id' => $this->estado_civil_id,
            'pais_id' => $this->pais_id,
            'distrito_id' => $this->distrito_id,

            'constancia_habilidad' => $this->constancia_habilidad,
            'declaracion_jurada' => $this->declaracion_jurada,
            'copia_dni' => $this->copia_dni,
            'rj_itse' => $this->rj_itse,
            'rj_verificador' => $this->rj_verificador,
            'anexo_1' => $this->anexo_1,
            'foto' => $this->foto,

            'created_at' => $this->created_at->toDateTimeString(),
            'roles' => $this->getRoleNames(),
            'permissions' => $this->getAllPermissions()->pluck('name'),
        ];
    }
}
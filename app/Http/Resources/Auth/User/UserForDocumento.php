<?php

namespace App\Http\Resources\Auth\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserForDocumento extends JsonResource
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
            'id'                => $this->id,

            'nombres'           => $this->nombres,
            'email'             => $this->email,
            'numero_documento'  => $this->numero_documento,

            'declaracion_jurada'=> $this->declaracion_jurada,
            'copia_dni'         => $this->copia_dni,
            'rj_itse'           => $this->rj_itse,
            'rj_verificador'    => $this->rj_verificador,
            'anexo_1'           => $this->anexo_1,
            'foto'              => $this->foto,

            'created_at'        => $this->created_at->toDateTimeString(),
        ];
    }
}

<?php

namespace App\Http\Resources\SeleccionAdhoc\Calificacion;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionFormacionCollection;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionCapacitacionCollection;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionExperienciaGeneralCollection;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionExperienciaInspectorCollection;
use App\Http\Resources\SeleccionAdhoc\Calificacion\CalificacionVerificacionRealizadaCollection;
class CalificacionWithDetailResource extends JsonResource
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
            'usuario_nombres'        => $this->user->nombres,
            'usuario_apellido_paterno'        => $this->user->apellido_paterno,
            'usuario_apellido_materno'        => $this->user->apellido_materno,
            'usuario_numero_documento'        => $this->user->numero_documento,
            'formaciones'            => new CalificacionFormacionCollection($this->user->formaciones, $this->id),
            'capacitaciones'         => new CalificacionCapacitacionCollection($this->user->capacitaciones, $this->id),
            'experiencias_generales'        => new CalificacionExperienciaGeneralCollection($this->user->experienciasGenerales, $this->id),
            'experiencias_inspector'        => new CalificacionExperienciaInspectorCollection($this->user->experienciasInspector, $this->id),
            'verificaciones_realizadas'     => new CalificacionVerificacionRealizadaCollection($this->user->verificacionesRealizadas, $this->id),
            'convocatoria_id'        => $this->convocatoria_id,
            'convocatoria_nombre'    => $this->convocatoria->nombre,
            'sede_registral_id'      => $this->sede_registral_id,
            'sede_registral_nombre'  => $this->sedeRegistral->nombre,
            
            'puntaje_total'          => $this->puntajeTotal(),
            'esta_acreditado'        => $this->estaAcreditado(),
            'esta_calificado'        => ($this->puntajeTotal() > 0) ? true : false,

            'created_at'             => $this->created_at->toDateTimeString(),
            'updated_at'             => $this->updated_at->toDateTimeString(),
        ];
    }
}
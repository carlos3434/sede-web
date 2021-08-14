<?php

namespace App\Http\Requests\RevisionExpediente;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EntregaExpedienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fecha_entrega'          => 'date_format:Y-m-d',
            'usuario_asignador_id'   => 'exists:App\Models\Auth\User,id',
            'acreditacion_id'        => 'required|exists:App\Models\SeleccionAdhoc\Acreditacion,id',
            'expediente_adhoc_id'    => 'required|exists:App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc,id',
        ];
    }

}

<?php

namespace App\Http\Requests\RevisionExpediente;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RevisionRequest extends FormRequest
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
            'observacion'                   => 'alpha_num_spaces|max:120',
            'fecha_revision'                => 'date_format:Y-m-d',
            'fecha_subsanacion'             => 'date_format:Y-m-d|after_or_equal:fecha_revision',
            'estado_revision_id'            => 'required|exists:App\Models\Settings\EstadoRevision,id',
            'expedienteadhoc_archivo_id'    => 'required|exists:App\Models\RegistroExpedienteAdhoc\ExpedienteAdhocArchivos,id',
        ];
    }

}

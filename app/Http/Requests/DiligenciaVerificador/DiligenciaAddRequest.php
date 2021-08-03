<?php

namespace App\Http\Requests\DiligenciaVerificador;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DiligenciaAddRequest extends FormRequest
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
            'expediente_adhoc_id'    => 'required|exists:App\Models\RegistroExpedienteAdhoc\ExpedienteAdhoc,id',
            'anexo8'                 => 'required|file|max:3072'
        ];
    }

}   
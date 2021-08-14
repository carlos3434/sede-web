<?php

namespace App\Http\Requests\RegistroExpedienteAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExpedienteAdhocAddVerificacionAdhocRequest extends FormRequest
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
    public function getFillableForVerificacionAdhoc()
    {
        return [
            'ht',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'ht'                    => 'required|integer',

        ];
    }

}

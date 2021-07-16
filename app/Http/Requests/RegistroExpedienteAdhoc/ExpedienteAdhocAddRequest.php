<?php

namespace App\Http\Requests\RegistroExpedienteAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExpedienteAdhocAddRequest extends FormRequest
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
            'nombre_comercial'  => 'required|alpha_num_spaces',
            'direccion'         => 'required|alpha_num_spaces',
            'area'              => 'required|integer'
        ];
    }

}

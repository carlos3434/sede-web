<?php

namespace App\Http\Requests\RegistroAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VerificacionRealizadaUpdateRequest extends FormRequest
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

            'nro_expediente'    => 'required|alpha_num_spaces',
            'fecha'             => 'required|date_format:Y-m-d',
            'nro_informe'       => 'required|alpha_num_spaces',
            'institucion_id'    => 'required|exists:instituciones,id',

        ];
    }

}

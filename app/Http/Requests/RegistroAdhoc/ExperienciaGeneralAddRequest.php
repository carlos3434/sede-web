<?php

namespace App\Http\Requests\RegistroAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExperienciaGeneralAddRequest extends FormRequest
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

            'especialidad'      => 'required|alpha_num_spaces|max:120',
            'fecha_expedicion'  => 'required|date_format:Y-m-d|before:'.date('Y-m-d'),
            'ciudad'            => 'required|alpha_num_spaces|max:80',
            'archivo_titulo'    => 'required|file|max:3072',
            'grado_id'          => 'required|exists:grados,id',
            'institucion_id'    => 'required|exists:instituciones,id',
        ];
    }

}

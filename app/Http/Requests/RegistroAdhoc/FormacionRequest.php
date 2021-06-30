<?php

namespace App\Http\Requests\RegistroAdhoc;

use Illuminate\Foundation\Http\FormRequest;

class FormacionRequest extends FormRequest
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

            'especialidad' => 'required|alpha_num_spaces',
            'fecha_expedicion' => 'required|date_format:Y-m-d|before:'.date('Y-m-d'),
            'ciudad' => 'required|alpha_num_spaces',
            'archivo_titulo' => 'required|file|max:3072',
            //'archivo_tamano' => 'required|alpha_num_spaces'
            'grado'           => 'exists:grados,id',
            'institucion'           => 'exists:instituciones,id',
            'usuario'           => 'exists:users,id',
        ];
    }

}

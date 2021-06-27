<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class InstitucionRequest extends FormRequest
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
            'nombre' => 'required|alpha_num_spaces',
            'etiqueta' => 'required|alpha_num_spaces',
            'tipo_institucion_id' => 'required|exists:tipos_instituciones,id',
            'pais' => 'required||exists:paises,id'
        ];
    }

}

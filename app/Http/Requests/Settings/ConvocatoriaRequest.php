<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class ConvocatoriaRequest extends FormRequest
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
            'activo' => 'required',
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'fecha_final' => 'required|date_format:Y-m-d',
        ];
    }

}

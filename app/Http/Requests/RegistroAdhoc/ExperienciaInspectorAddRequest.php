<?php

namespace App\Http\Requests\RegistroAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExperienciaInspectorAddRequest extends FormRequest
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

            'institucion_id'       => 'required|exists:instituciones,id',
            'fecha_inicio'         => 'required|date_format:Y-m-d|before_or_equal:fecha_fin',
            'fecha_fin'            => 'required|date_format:Y-m-d|before:' . date('Y-m-d'),
            'archivo_constancia'   => 'required|file|max:3072',
        ];
    }

}

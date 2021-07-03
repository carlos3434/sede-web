<?php

namespace App\Http\Requests\RegistroAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CapacitacionUpdateRequest extends FormRequest
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
            'nombre'                => 'required|alpha_num_spaces',
            'fecha_inicio'          => 'required|date_format:Y-m-d|before_or_equal:fecha_termino',
            'fecha_termino'         => 'required|date_format:Y-m-d|before:' . date('Y-m-d'),
            'horas_lectivas'        => 'required|integer',
            'ciudad'                => 'required|alpha_num_spaces',
            'tipo_capacitacion_id'  => 'required|exists:tipos_capacitaciones,id',
            'institucion_id'        => 'required|exists:instituciones,id',
            'certificado'           => 'file|max:3072',
        ];
    }

}

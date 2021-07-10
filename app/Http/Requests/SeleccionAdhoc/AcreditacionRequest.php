<?php

namespace App\Http\Requests\SeleccionAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AcreditacionRequest extends FormRequest
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
            'calificacion_id'   => 'required|exists:calificaciones,id',
            'fecha_inicio'      => 'required|date_format:Y-m-d|before_or_equal:fecha_fin',
            'fecha_fin'         => 'required|date_format:Y-m-d'
        ];
    }

}

<?php

namespace App\Http\Requests\RegistroExpedienteAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExpedienteAdhocAddHojaTramiteRequest extends FormRequest
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
    public function getFillableForAddHojaTramite()
    {
        return [
            'numero_operacion',
            'nombre_banco',
            'agencia',
            'fecha_operacion',
            'monto',
            'distrito_id',
            'recibo_pago',
            'archivo_solicitud_ht'
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

            'numero_operacion'      => 'required|alpha_num_spaces',
            'nombre_banco'          => 'required|alpha_num_spaces',
            'agencia'               => 'required|alpha_num_spaces',
            'fecha_operacion'       => 'required|date_format:Y-m-d',
            'monto'                 => 'required|numeric|between:0,9999.99',
            'distrito_id'           => 'required|exists:distritos,id',
            'recibo_pago'           => 'required|file|max:11264',
            'archivo_solicitud_ht'  => 'required|file|max:11264',

        ];
    }

}

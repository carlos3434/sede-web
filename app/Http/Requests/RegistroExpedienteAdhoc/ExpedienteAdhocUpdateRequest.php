<?php

namespace App\Http\Requests\RegistroExpedienteAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExpedienteAdhocUpdateRequest extends FormRequest
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

            'nombre_comercial'  => 'alpha_num_spaces',
            'direccion'         => 'alpha_num_spaces',
            'area'              => 'integer',
/*
            'carta_poder_simple' => 'file|max:11264',
            'copia_vigencia_poder' => 'file|max:11264',
            'copia_partida_registral' => 'file|max:11264',
            'copia_dni_propietario' => 'file|max:11264',
            'copia_formulario_for' => 'file|max:11264',
            'informe_tecnico_verificador_responsable' => 'file|max:11264',
            'esquela_observacion_sunarp' => 'file|max:11264',
            'memoria_descriptiva_seguridad' => 'file|max:11264',
            'certificado_pozo_tierra' => 'file|max:11264',
            'certificado_laminados' => 'file|max:11264',
            'certificado_sistema_electrico' => 'file|max:11264',

            'plano_ubicacion_01' => 'file|max:11264',
            'plano_ubicacion_02' => 'file|max:11264',
            'plano_arquitectura_1' => 'file|max:11264',
            'plano_arquitectura_2' => 'file|max:11264',
            'plano_arquitectura_3' => 'file|max:11264',
            'plano_arquitectura_4' => 'file|max:11264',
            'plano_arquitectura_5' => 'file|max:11264',
            'plano_arquitectura_6' => 'file|max:11264',
            'plano_arquitectura_7' => 'file|max:11264',
            'plano_arquitectura_8' => 'file|max:11264',
            'plano_arquitectura_9' => 'file|max:11264',
            'plano_arquitectura_10' => 'file|max:11264',

            'plano_fabrica_1' => 'file|max:11264',
            'plano_fabrica_2' => 'file|max:11264',
            'plano_fabrica_3' => 'file|max:11264',
            'plano_fabrica_4' => 'file|max:11264',
            'plano_fabrica_5' => 'file|max:11264',
            'plano_fabrica_6' => 'file|max:11264',
            'plano_fabrica_7' => 'file|max:11264',
            'plano_fabrica_8' => 'file|max:11264',
            'plano_fabrica_9' => 'file|max:11264',
            'plano_fabrica_10' => 'file|max:11264',

            'plano_remodelacion_1' => 'file|max:11264',
            'plano_remodelacion_2' => 'file|max:11264',
            'plano_remodelacion_3' => 'file|max:11264',
            'plano_remodelacion_4' => 'file|max:11264',
            'plano_remodelacion_5' => 'file|max:11264',
            'plano_remodelacion_6' => 'file|max:11264',
            'plano_remodelacion_7' => 'file|max:11264',
            'plano_remodelacion_8' => 'file|max:11264',
            'plano_remodelacion_9' => 'file|max:11264',
            'plano_remodelacion_10' => 'file|max:11264',

            'plano_ampliacion_1' => 'file|max:11264',
            'plano_ampliacion_2' => 'file|max:11264',
            'plano_ampliacion_3' => 'file|max:11264',
            'plano_ampliacion_4' => 'file|max:11264',
            'plano_ampliacion_5' => 'file|max:11264',
            'plano_ampliacion_6' => 'file|max:11264',
            'plano_ampliacion_7' => 'file|max:11264',
            'plano_ampliacion_8' => 'file|max:11264',
            'plano_ampliacion_9' => 'file|max:11264',
            'plano_ampliacion_10' => 'file|max:11264',

            'plano_rutas_evacuacion_1' => 'file|max:11264',
            'plano_rutas_evacuacion_2' => 'file|max:11264',
            'plano_rutas_evacuacion_3' => 'file|max:11264',
            'plano_rutas_evacuacion_4' => 'file|max:11264',
            'plano_rutas_evacuacion_5' => 'file|max:11264',
            'plano_rutas_evacuacion_6' => 'file|max:11264',
            'plano_rutas_evacuacion_7' => 'file|max:11264',
            'plano_rutas_evacuacion_8' => 'file|max:11264',
            'plano_rutas_evacuacion_9' => 'file|max:11264',
            'plano_rutas_evacuacion_10' => 'file|max:11264',

            'plano_senalizacion_1' => 'file|max:11264',
            'plano_senalizacion_2' => 'file|max:11264',
            'plano_senalizacion_3' => 'file|max:11264',
            'plano_senalizacion_4' => 'file|max:11264',
            'plano_senalizacion_5' => 'file|max:11264',
            'plano_senalizacion_6' => 'file|max:11264',
            'plano_senalizacion_7' => 'file|max:11264',
            'plano_senalizacion_8' => 'file|max:11264',
            'plano_senalizacion_9' => 'file|max:11264',
            'plano_senalizacion_10' => 'file|max:11264',
*/
        ];
    }

}

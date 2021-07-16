<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nombres'                   => 'required|string',
            'email'                     => 'required|unique:users,email,'. (isset($this->user->id) ? $this->user->id : 0),

            'apellido_paterno'          => 'required|string',
            'apellido_materno'          => 'required|string',
            'pais_id'                   => 'required|exists:paises,id',
            'sexo'                      => 'required|boolean',
            'estado_civil_id'           => 'exists:estado_civil,id',
            'tipo_documento_id'         => 'required|exists:tipos_documentos,id',
            'numero_documento'          => 'required|unique:users,numero_documento,'. (isset($this->user->id) ? $this->user->id : 0),
            'direccion'                 => 'string',
            'distrito_id'               => 'required|exists:distritos,id',
            'telefono_fijo'             => 'required|string',
            'celular'                   => 'required|string',
            'password'                  => 'required|confirmed|min:6',
            'colegio_profesional'       => 'string',
            'numero_colegiatura'        => 'string',
            'esta_habilitado'           => 'boolean',
            'profesion'                 => 'string',
            'constancia_habilidad'      => 'file|max:3072',//2048
            'declaracion_jurada'        => 'file|max:3072',
            'copia_dni'                 => 'file|max:3072',
            'rj_itse'                   => 'file|max:3072',
            'rj_verificador'            => 'file|max:3072',
            'anexo_1'                   => 'file|max:3072',
            'foto'                      => 'file|max:3072',

            'roles'                     => 'string|exists:roles,name',
            'permissions'               => 'string|exists:permissions,name'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El :attribute es un campo requerido',
            'name.alpha_num' => 'El :attribute debe solo contener numeros y letras',
            'email.required' => 'El :attribute es un campo requerido',
            'email.email' => 'El :attribute debe ser un email valido',
            'email.unique' => ':attribute ya se a registrado',
            'password.required' => 'El :attribute es un campo requerido',
            'password.min' => 'El :attribute debe contener al menos 8 caracteres',
            'roles.exists' => 'El :attribute seleccionado es invalido',
            'permissions.exists' => 'El :attribute seleccionado es invalido'
            // ..
        ];
    }
}

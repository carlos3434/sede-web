<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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

    public function getFillable()
    {
        return [
            'tipo_documento_id',
            'numero_documento',
            'apellido_paterno',
            'apellido_materno',
            'nombres',
            'sexo',
            'telefono_fijo',
            'celular',
            'estado_civil_id',
            'direccion',
            //'password',
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
            //campos editables
            'tipo_documento_id'         => 'required|exists:tipos_documentos,id',
            'numero_documento'          => 'required|unique:users,numero_documento,'. (isset($this->user->id) ? $this->user->id : 0),
            'apellido_paterno'          => 'required|string',
            'apellido_materno'          => 'required|string',
            'nombres'                   => 'required|string',
            'sexo'                      => 'required|boolean',
            'telefono_fijo'             => 'required|string',
            'celular'                   => 'required|string',
            'estado_civil_id'           => 'exists:estado_civil,id',
            'direccion'                 => 'string',
            'password'                  => 'min:8',
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

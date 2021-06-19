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
            'name' => 'required|alpha_num_spaces',
            'email'        => 'required|unique:users,email,'. (isset($this->user->id) ? $this->user->id : 0),
            //'password' => 'required|min:8',
            //'roles' => 'exists:roles,id',
            //'permissions' => 'exists:permissions,id'
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
            //'roles.exists' => 'El :attribute seleccionado es invalido',
            //'permissions.exists' => 'El :attribute seleccionado es invalido'
            // ..
        ];
    }
}

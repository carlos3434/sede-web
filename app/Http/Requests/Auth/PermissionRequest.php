<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            //'slug' => 'required|alpha_dash|unique:permissions,slug,'. (isset($this->permission->id) ? $this->permission->id : 0).'|starts_with:,SEND_,NAV_,EXPORT_,READ_,DETAIL_,CREATE_,UPDATE_,DELETE_',
            'description' => 'required|alpha_num_spaces'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El :attribute es un campo requerido',
            'name.alpha_num_spaces' => 'El :attribute solo puede contener caracteres alfanumericos, espacios, guin bajo y guines',
            //'slug.required' => 'El :attribute es un campo requerido',
            //'slug.alpha_dash' => 'El :attribute puede solo contener letras, numeros, guiones y suiones bajo.',
            //'slug.unique' => 'El :attribute ya ha sido tomado',
            //'slug.starts_with' => 'El :attribute debe iniciar con uno de los siguientes valores: , READ_, DETAIL_, CREATE_, UPDATE_, DELETE_',
            'description.required' => 'El :attribute es un campo requerido',
            'description.alpha_num_spaces' => 'El :attribute solo puede contener caracteres alfanumericos, espacios, guin bajo y guines',
            // ..
        ];
    }
}

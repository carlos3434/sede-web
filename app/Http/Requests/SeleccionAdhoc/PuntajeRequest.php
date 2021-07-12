<?php

namespace App\Http\Requests\SeleccionAdhoc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PuntajeRequest extends FormRequest
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
        $rules = [
            'calificacion_id'    => 'required|exists:calificaciones,id'
        ];
        if ($this->request->has('puntajes') && is_array($this->request->get('puntajes')) ) {
            foreach($this->request->get('puntajes') as $key => $val)
            {

                $rules['puntajes.'.$key.'.categoria_id']     = 'required|exists:categorias,id';
                $rules['puntajes.'.$key.'.item_id']          = 'required|exists:items,id';
            }
        }
        return $rules;
    }

}

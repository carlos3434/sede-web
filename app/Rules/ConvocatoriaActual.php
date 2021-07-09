<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Settings\Convocatoria;

class ConvocatoriaActual implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (isset( Convocatoria::GetActual()->id )) ? true: false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.convocatoriaactual');
    }
}

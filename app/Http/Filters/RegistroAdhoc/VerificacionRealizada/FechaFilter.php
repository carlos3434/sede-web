<?php
namespace App\Http\Filters\RegistroAdhoc\Formacion;

class FechaFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha) {
                    if (validateDate($fecha)) {
                        $builder->orWhere('fecha', date("Y-m-d", strtotime($fecha)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('fecha', $value);
        }
        return $builder;
    }
}
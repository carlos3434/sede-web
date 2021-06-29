<?php
namespace App\Http\Filters\RegistroAdhoc\Formacion;

class FechaExpedicionFilter
{
    public function filter($builder, $value)
    {
        if (is_array($value) && count($value) > 0) {
            $builder->where(function ($builder) use ( $value ) {
                foreach ( $value as $fecha) {
                    if (validateDate($fecha)) {
                        $builder->orWhere('fecha_final', date("Y-m-d", strtotime($fecha)) );
                    }
                }
            });
        } elseif (validateDate($value)) {
            $builder->where('fecha_final', $value);
        }
        return $builder;
    }
}
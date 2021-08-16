<?php
namespace App\Http\Filters\Commons;

class EstadosExpedienteFilter
{
    public function filter($builder, array $values = [])
    {
        return $builder->whereIn('estado_expediente_id', $values);
    }
}
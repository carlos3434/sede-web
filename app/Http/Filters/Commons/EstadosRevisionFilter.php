<?php
namespace App\Http\Filters\Commons;

class EstadosRevisionFilter
{
    public function filter($builder, array $values = [])
    {
        return $builder->whereIn('estado_revision_id', $values);
    }
}
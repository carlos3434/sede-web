<?php
namespace App\Http\Filters\RegistroExpedienteAdhoc\ExpedienteAdhoc;

class NombreComercialFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('nombre_comercial', 'like', '%'.$value.'%');
    }
}
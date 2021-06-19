<?php
namespace App\Http\Filters\Auth\User;

class EmailFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('email', $value);
    }
}
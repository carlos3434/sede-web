<?php
namespace App\Http\Filters\User;

class EmailFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('email', $value);
    }
}
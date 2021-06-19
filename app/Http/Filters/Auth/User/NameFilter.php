<?php
namespace App\Http\Filters\Auth\User;

class NameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('name', 'like', '%'.$value.'%');
    }
}
<?php
namespace App\Http\Filters\Auth;


use App\Http\Filters\AbstractFilter;

class UserFilter extends AbstractFilter
{
    protected $filters = [
        'name' => User\NameFilter::class,
        'email' => User\EmailFilter::class,
    ];
}
<?php

namespace App\Repositories\Auth\Interfaces;

use  App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface 
{

    public function findByUsername($username);
    public function getOneForLogin($user);
}
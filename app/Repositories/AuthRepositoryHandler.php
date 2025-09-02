<?php

namespace App\Repositories;

use App\Interfaces\Repositories\AuthRepository;
use App\Models\User;

class AuthRepositoryHandler implements AuthRepository
{
    public function register(array $data)
    {
        return User::create($data);
    }
}
<?php

namespace App\Interfaces\Repositories;

use App\Models\User;

interface AuthRepository
{
    public function register(array $data);
}
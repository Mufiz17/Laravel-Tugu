<?php

namespace App\User\Commands;

use App\Interfaces\Services\AuthService;

class RegisterCommand
{
    public function __construct(
        private AuthService $service
    )
    {}

    public function execute(array $data)
    {
       return $this->service->register([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
       ]);
    }
}
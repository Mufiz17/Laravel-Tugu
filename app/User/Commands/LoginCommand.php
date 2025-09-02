<?php

namespace App\User\Commands;

use App\Interfaces\Services\AuthService;

class LoginCommand
{
    public function __construct(
        private AuthService $service
    ) {}

    public function execute(array $data)
    {
        return $this->service->login([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
}

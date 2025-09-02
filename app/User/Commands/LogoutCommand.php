<?php

namespace App\User\Commands;

use App\Interfaces\Services\AuthService;

class LogoutCommand
{
    public function __construct(
        private AuthService $service
    ) {}

    public function execute()
    {
        return $this->service->logout();
    }
}

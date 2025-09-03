<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User\Commands\LoginCommand;
use App\User\Commands\LogoutCommand;
use App\User\Commands\RegisterCommand;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private RegisterCommand $registerCommand,
        private LoginCommand $loginCommand,
        private LogoutCommand $logoutCommand
    ) {
        $this->registerCommand = $registerCommand;
        $this->loginCommand = $loginCommand;
        $this->logoutCommand = $logoutCommand;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->registerCommand->execute($request->validated(), 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->loginCommand->execute($request->validated());
    }


    public function profile(Request $request)
    {
        return response()->json($request->user());
    }


    public function logout(): JsonResponse
    {
        return $this->logoutCommand->execute();
    }
}

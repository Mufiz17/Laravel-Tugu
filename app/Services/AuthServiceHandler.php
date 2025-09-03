<?php

namespace App\Services;

use App\Interfaces\Repositories\AuthRepository;
use App\Interfaces\Services\AuthService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class AuthServiceHandler implements AuthService
{
    public function __construct(
        private AuthRepository $repository
    ) {}

    public function register(array $data)
    {
        $user = $this->repository->register($data);
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    public function login(array $data)
    {
        if (!$token = auth('api')->attempt($data)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out'])->withoutCookie('jwt');
    }

    public function respondWithToken($token)
    {
        $cookie = cookie(
            'jwt',
            $token,
            auth('api')->factory()->getTTL(), // menit
            '/',
            null,
            false, // ganti ke true kalau sudah pakai https
            true   // HttpOnly
        );

        return response()->json(['message' => 'Login berhasil'])->cookie($cookie);
    }
}

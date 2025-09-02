<?php

namespace App\Interfaces\Services;

use Illuminate\Http\Request;

interface AuthService
{
    public function register(array $data);
    public function login(array $data);
    public function logout();
    public function respondWithToken($token);
}

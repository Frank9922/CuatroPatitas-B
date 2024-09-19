<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function registerRefugio() : JsonResponse {

    }

    public function register(RegisterUserRequest $request) : JsonResponse {
        return $this->authService->registrarUsuario($request->all());
    }
    
    public function login(LoginUserRequest $request) : JsonResponse {
        return $this->authService->login($request->all());
    }


    public function logout(Request $request) : JsonResponse {
        return $this->authService->logoutUsuario($request);
    }

    public function user(Request $request)  {
        return $this->authService->getAuthenticatedUser($request);
    }

    public function verifyToken(Request $request) : JsonResponse {
        return $this->authService->verifyEmail($request->get('token'));
    }

}

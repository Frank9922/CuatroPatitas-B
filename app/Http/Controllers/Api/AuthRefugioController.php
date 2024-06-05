<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthRefugioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthRefugioController extends Controller
{
    private $authRefugioService;

    public function __construct(AuthRefugioService $authRefugioService)
    {
        $this->authRefugioService = $authRefugioService;
    }

    public function register(Request $request) : JsonResponse {
        return $this->authRefugioService->registrarRefugio($request->all());
    }

    public function login(Request $request) : JsonResponse {
        return $this->authRefugioService->loginRefugio($request->all());
    }

    public function logout(Request $request) : JsonResponse {
        return $this->authRefugioService->logoutRefugio($request);
    }

    public function refugio(Request $request) : JsonResponse {
        return $this->authRefugioService->refugio($request);
    }

    public function verifyToken(Request $request) : JsonResponse {
        return $this->authRefugioService->verifyEmailRefugio($request->get('token'));
    }
}

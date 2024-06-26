<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\RefugioService;
use Illuminate\Http\JsonResponse;

class RefugioController extends Controller
{
    private $refugioService;

    public function __construct(RefugioService $refugioService)
    {
        $this->refugioService = $refugioService;
    }

    public function index() : JsonResponse {
        return $this->refugioService->getRefugios();
    }
}

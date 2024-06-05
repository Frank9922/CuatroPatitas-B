<?php 

namespace App\Http\Services;

use Illuminate\Http\JsonResponse;

class ResponseService {

    public function successResponse($data = null, $statusCode = 200) : JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    public function errorResponse($data = null, $statusCode = 400) : JsonResponse
    {
        return response()->json($data, $statusCode);
    }
}




?>
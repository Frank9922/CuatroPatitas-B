<?php

namespace App;

use Illuminate\Http\JsonResponse;

class ApiResponse
{


    public static function successResponse($data = null, $statusCode = 200) : JsonResponse
    {
        return response()->json([
            'ok' => true,
            ...$data
        ], $statusCode);
    }

    public static function errorResponse($data = null, $statusCode = 400) : JsonResponse
    {
        return response()->json([
            'ok' => false,
            ...$data
        ], $statusCode);
    }
}




?>
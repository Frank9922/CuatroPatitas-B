<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AlreadyAuthenticatedException extends Exception
{
    public function render(): JsonResponse
    {  
        return response()->json(['message' => __('Already Authenticated')], 403);
    }
}

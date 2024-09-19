<?php

namespace App\Http\Middleware;

use App\Exceptions\AlreadyAuthenticatedException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateUserOrRefugio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if(Auth::guard('web')->check() || Auth::guard('refugio')->check()) {

            return $next($request);

        }

        if($request->expectsJson()) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        throw new AlreadyAuthenticatedException();
    }
}

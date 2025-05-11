<?php

namespace App\Http\Middleware;

use App\Http\Services\ApiResponse\Facades\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('sanctum')->check()){
            return ApiResponse::withStatus(401)->withMessage("Unauthorized .")->send();
        }
        return $next($request);
    }
}

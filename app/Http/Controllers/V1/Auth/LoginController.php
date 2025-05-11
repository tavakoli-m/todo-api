<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Resources\V1\Auth\LoginApiResource;
use App\Http\Services\ApiResponse\Facades\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if(!Auth::attempt($request->validated())){
            return ApiResponse::withStatus(401)->withMessage('Invalid Credentials')->send();
        }

        return ApiResponse::withStatus(200)->withMessage('Login Successful')->withData(new LoginApiResource(Auth::user()))->send();
    }
}

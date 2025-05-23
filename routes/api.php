<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth');


Route::prefix('v1')->group(function (){
    Route::post('/register',\App\Http\Controllers\V1\Auth\RegisterController::class);
    Route::post('/login',\App\Http\Controllers\V1\Auth\LoginController::class);


    Route::apiResource('todo',\App\Http\Controllers\V1\TodoController::class)->middleware('auth');
});

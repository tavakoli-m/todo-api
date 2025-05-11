<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth');


Route::prefix('v1')->group(function (){
    Route::post('/register',\App\Http\Controllers\V1\Auth\RegisterController::class);
});

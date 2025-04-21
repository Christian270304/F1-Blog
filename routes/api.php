<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

Route::middleware('auth:api')->group(function () {
    Route::get('/article', [ApiController::class, 'getArticles']);
    Route::get('/users', [ApiController::class, 'getUsers']);
    Route::get('/article/{id}', [ApiController::class, 'getArticleById']);
    Route::get('/user/{id}', [ApiController::class, 'getUserById']);
});

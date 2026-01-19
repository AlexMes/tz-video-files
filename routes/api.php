<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\FileController;

Route::post('login', LoginController::class)->middleware('guest');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/file/list', [FileController::class, 'index']);
    Route::get('/file', [FileController::class, 'file']);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
    return $request->user();
});
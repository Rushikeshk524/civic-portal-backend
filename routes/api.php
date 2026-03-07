<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::Post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/complaints', [ComplaintController::class, 'index']);
    Route::post('/complaints', [ComplaintController::class, 'store']);
    Route::get('/complaints/{id}', [ComplaintController::class, 'show']);

    Route::get('/admin/complaints', [AdminController::class, 'allComplaints']);
    Route::patch('/admin/complaints/{id}/assign', [AdminController::class, 'assign']);
    Route::patch('/admin/complaints/{id}/status', [AdminController::class, 'updateStatus']);
    Route::get('/admin/stats', [AdminController::class, 'stats']);

});



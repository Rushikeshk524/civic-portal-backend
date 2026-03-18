<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Complaints
    Route::get('/complaints', [ComplaintController::class, 'index']);
    Route::post('/complaints', [ComplaintController::class, 'store']);
    Route::get('/complaints/{id}', [ComplaintController::class, 'show']);

    // Feed
    Route::get('/feed', [ComplaintController::class, 'feed']);

    // Comments
    Route::get('/complaints/{id}/comments', [CommentController::class, 'index']);
    Route::post('/complaints/{id}/comments', [CommentController::class, 'store']);

    // Likes
    Route::post('/complaints/{id}/like', [LikeController::class, 'toggle']);
    Route::get('/complaints/{id}/likes', [LikeController::class, 'count']);

    // Admin
    Route::get('/admin/complaints', [AdminController::class, 'allComplaints']);
    Route::patch('/admin/complaints/{id}/assign', [AdminController::class, 'assign']);
    Route::patch('/admin/complaints/{id}/status', [AdminController::class, 'updateStatus']);
    Route::get('/admin/stats', [AdminController::class, 'stats']);
    Route::delete('/admin/complaints/{id}', [AdminController::class, 'destroy']);

    // Categories
    Route::get('/categories', function () {
        return \App\Models\Category::all();
    });

    // Locations
    Route::post('/locations', function (\Illuminate\Http\Request $request) {
        $location = \App\Models\Location::firstOrCreate(
            [
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
            ],
            [
                'area_name' => $request->area_name,
                'pincode'   => $request->pincode,
            ]
        );
        return response()->json($location);
    });
});
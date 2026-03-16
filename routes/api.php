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

    Route::delete('/admin/complaints/{id}', [AdminController::class, 'destroy']);
    Route::get('/categories', function() {
        return \App\Models\Category::all();
    });

    Route::post('/locations', function(\Illuminate\Http\Request $request) {
        $location = \App\Models\Location::firstOrCreate(
            [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ],
            [
                'area_name' => $request->area_name,
                'pincode' => $request->pincode,
            ]
        );
        return response()->json($location);
    });
});



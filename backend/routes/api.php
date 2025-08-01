<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Posts\PostInteractionController;
use App\Http\Controllers\User\ProfileController;

// Public Auth Routes
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/googleAuth', [LoginController::class, 'redirectToAuth']);
Route::get('/auth/callback', [LoginController::class, 'handleAuthCallback']);

// Token Validation
Route::middleware('auth:sanctum')->get('/auth/validate', function () {
    return response()->json(['message' => 'Token is valid'], 200);
});

// User Routes
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::patch('/', [ProfileController::class, 'updateUserData']);
    Route::delete('/', [ProfileController::class, 'deleteUserAccount']);
    Route::get('/posts', [PostController::class, 'getUserPosts']);
    Route::get('/posts/saved', [PostController::class, 'getSavedPosts']);
    Route::get('/posts/{id}', [PostController::class, 'getUserPost']); // for edit/delete
});

// Visited User Profile
Route::middleware('auth:sanctum')->get('/users/{user}', [ProfileController::class, 'getVisitedUser']);

// Post Routes
Route::middleware('auth:sanctum')->prefix('posts')->group(function () {
    Route::get('/home', [PostController::class, 'getHomePosts']);
    Route::get('/search', [PostController::class, 'postSearch']);
    Route::get('/{id}', [PostController::class, 'getPost']); // public view

    Route::post('/', [PostController::class, 'store']);
    Route::patch('/{post}', [PostController::class, 'update'])->middleware('can:update,post');
    Route::delete('/{post}', [PostController::class, 'destroy'])->middleware('can:delete,post');

    Route::post('/{post}/save', [PostInteractionController::class, 'togglePostSave']);
    Route::post('/{post}/like', [PostInteractionController::class, 'togglePostLike']);
});

// Misc
Route::get('/img', fn() => response()->json([
    'img' => 'posts/deYx5CcsQ7amYYPxachEJQVRVpRktb4u1MoC8bpj.jpg.webp'
], 200));


// Test Route
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Test API route is working!',
        'timestamp' => now(),
        'data' => [
            'server_time' => date('Y-m-d H:i:s'),
            'environment' => config('app.env'),
            'debug' => config('app.debug')
        ]
    ], 200);
});

<?php

use App\Http\Controllers\Api\PostController; 
use App\Http\Controllers\Api\CommentController; 
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () { 
    Route::apiResource('posts', PostController::class); 
    Route::put('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
    Route::get('posts/{post}/comments', [PostController::class, 'comments']);
    
    Route::post('posts/{post}/comments', [CommentController::class, 'store']); 
    Route::post('comments', [CommentController::class, 'store']); 
    Route::put('comments/{comment}', [CommentController::class, 'update']); 
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

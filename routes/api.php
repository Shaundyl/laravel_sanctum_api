<?php

use App\Http\Controllers\Api\PostController; 
use App\Http\Controllers\Api\CommentController; 
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () { 
Route::apiResource('posts', PostController::class); 
Route::post('comments', [CommentController::class, 'store']); 
Route::put('comments/{comment}', [CommentController::class, 'update']); 
Route::delete('comments/{comment}', [CommentController::class, 
'destroy']); 
});
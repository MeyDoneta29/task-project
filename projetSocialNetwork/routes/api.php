<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::post('/auth/signup', [UserController::class, 'signup']);
Route::post('/auth/signin', [UserController::class, 'signin']);
// Alias for frontend expecting `/api/auth/login`
Route::post('/auth/login', [UserController::class, 'signin']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function() {
  echo 'test';
}
);

Route::get('/posts',[PostController::class, 'index']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/posts', [PostController::class, 'poster']);
    Route::post('/posts/{post_id}/likes', [PostController::class, 'likes']);
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Public routes 
//route sign in
Route::post('/login',[AuthController::class,'login']);
//route sign up
Route::post('/register',[AuthController::class,'register']);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function(){

    //User
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/logout', [AuthController::class, 'logout']);

    //Post
    Route::get('/posts',[PostController::class, 'index']); //all posts
    Route::post('/posts',[PostController::class, 'store']); //create post
    Route::get('/posts/{id}',[PostController::class, 'show']); //1 post
    Route::put('/posts/{id}',[PostController::class, 'update']);
    Route::delete('/posts/{id}',[PostController::class, 'destroy']);

    //comment
    Route::get('/posts/{id}/comments',[CommentController::class, 'index']); //all comments of a post
    Route::post('/posts/{id}/comments',[CommentController::class, 'store']);
     Route::put('/comments/{id}',[PostController::class, 'update']);
     Route::delete('/comments/{id}',[PostController::class, 'destroy']);


     //Like
     Route::post('/posts/{id}/likes',[LikeController::class, 'LikeOrUnlike']);



});
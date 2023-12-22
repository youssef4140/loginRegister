<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request){
        return $request->user();
        
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::post('/post',[PostController::class, 'create']);

    Route::delete('/post/{id}',[PostController::class, 'delete']);

    Route::patch('/post/{id}',[PostController::class, 'update']);


});

Route::get('/post',[PostController::class, 'posts']);

Route::get('/post/{id}',[PostController::class, 'postById']);

Route::get('/user/posts/{id}',[PostController::class, 'userPostsById']);







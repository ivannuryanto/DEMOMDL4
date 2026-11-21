<?php

use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/media', [MediaController::class, 'index']);
Route::post('/media', [MediaController::class, 'store']);
Route::get('/media/{media}', [MediaController::class, 'show']);
Route::put('/media/{media}', [MediaController::class, 'update']);
Route::patch('/media/{media}', [MediaController::class, 'update']);
Route::delete('/media/{media}', [MediaController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::patch('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);
Route::get('/users/{user}/collections', [UserController::class, 'collections']);
Route::post('/users/{user}/collections/{media}', [UserController::class, 'addToCollection']);
Route::delete('/users/{user}/collections/{media}', [UserController::class, 'removeFromCollection']);

Route::get('/users/{user}/favorites', [UserController::class, 'favorites']);
Route::post('/users/{user}/favorites/{media}', [UserController::class, 'addFavorite']);
Route::delete('/users/{user}/favorites/{media}', [UserController::class, 'removeFavorite']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatabaseController;




Route::post('register',[AuthController::class,'register']); //register
Route::post('login',[AuthController::class,'login']); //login user
Route::put('user',[AuthController::class,'update']); //update user

Route::post('disable',[AuthController::class,'disable']); //disable user
Route::post('enable',[AuthController::class,'enable']); //enable user
Route::get('users',[AuthController::class,'index']); //muti users
Route::get('user',[AuthController::class,'show']); //single user
Route::delete('user',[AuthController::class,'delete']); //delete user


Route::prefix('real-db')->group(function()
{
    Route::post('/', [DatabaseController::class, 'store']);
    Route::get('/', [DatabaseController::class, 'index']);
    Route::put('/', [DatabaseController::class, 'update']);
    Route::delete('/', [DatabaseController::class, 'delete']);
});



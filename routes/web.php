<?php

use App\Http\Controllers\CodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

// User Related Routes
Route::get('/', [UserController::class, 'login'])->middleware('guest')->name('login');

Route::get('/register', [UserController::class, 'register'])->middleware('guest')->name('register');

Route::get('/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');

Route::get('/logout', [UserController::class, 'logout'])->middleware(('loginRequired'));

Route::post('/register', [UserController::class, 'signUp'])->middleware('guest');

Route::post('/login', [UserController::class, 'authenticate'])->middleware('guest');

Route::post('/reset-password', [UserController::class, 'updatePassword']);


// Code Related Routes
Route::post('/email-code', [CodeController::class, 'emailCode']);

Route::post('/verify-code', [CodeController::class, 'validateCode']);


// Profile Related Routes
Route::get('/home', [ProfileController::class, 'home'])->middleware('loginRequired')->name('home');

Route::get('/edit-avatar', [ProfileController::class, 'displayEditAvatar'])->middleware('loginRequired');

Route::post('/edit-avatar', [ProfileController::class, 'saveAvatar'])->middleware('loginRequired');

Route::delete('/delete-user/{user:username}', [ProfileController::class, 'deleteAccount'])->middleware('loginRequired');

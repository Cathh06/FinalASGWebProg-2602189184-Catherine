<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FriendRequestController;

Route::get('/', function () {
    $users = User::all();
    return view('home2', compact('users'));
});

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/payment', [RegisterController::class, 'showpayment'])->name('payment');
Route::post('/payment', [RegisterController::class, 'payment'])->name('processpayment');
Route::post('/storebalance', [RegisterController::class, 'storebalance'])->name('coin-store');


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'loginvalidate'])->name('login');

Route::post('/logout', [LoginController::class, 'logout']);


Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('friend-request', FriendRequestController::class);
    Route::resource('friend', FriendController::class);
    Route::resource('message', MessageController::class);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', [HomeController::class, 'getIndex'])->name('home');
    Route::get('messages', [HomeController::class, 'getMessages'])->name('messages');
    Route::post('post_messages', [HomeController::class, 'postMessages'])->name('post_messages');
    Route::post('update_messages', [HomeController::class, 'updateMessages'])->name('update_messages');
    Route::post('delete_messages', [HomeController::class, 'deleteMessages'])->name('delete_messages');
    // Route::post('post_messages', [MemberController::class, 'postMessages'])->name('post_messages');

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('post_login', [AuthController::class, 'postLogin'])->name('post_login');
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('post_register', [AuthController::class, 'postRegister'])->name('post_register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return '登入成功才能看到的頁面';
    });
});

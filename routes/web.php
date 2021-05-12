<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return view('home');
});

//Auth::routes(['register' => false]);

// Login And Register Part
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('show_login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('show_register');
Route::post('/register', [RegisterController::class, 'manualRegister'])->name('manual_register');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

// Admin Dashboard
Route::get('/admin/dash', [AdminController::class, 'showUser'])->name('admin.dash')->middleware('is_admin');
Route::post('/admin/user_check', [AdminController::class, 'userCheck']);

// User Pages
Route::get('/profile', [HomeController::class, 'profilePage']);

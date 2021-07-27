<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;
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
Route::get('/verify/{token}', [RegisterController::class, 'verifyEmail']);
Route::get('/verify', [RegisterController::class, 'verifyEmailSuccess'])->name('verify_success');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

// Admin Dashboard
Route::get('/admin/dash', [AdminController::class, 'showUser'])->name('admin.dash')->middleware('is_admin');
Route::post('/admin/user_check', [AdminController::class, 'userCheck'])->middleware('is_admin');
Route::post('/admin/user_delete', [AdminController::class, 'userDelete'])->middleware('is_admin');
Route::get('/admin/account', [AdminController::class, 'showAccount'])->middleware('is_admin');
Route::post('/admin/create_account', [AdminController::class, 'createAccount'])->middleware('is_admin');
Route::post('/admin/account_add_point', [AdminController::class, 'accountAddPoint'])->middleware('is_admin');
Route::get('/admin/group', [AdminController::class, 'showGroup'])->middleware('is_admin');
Route::post('/admin/create_group', [AdminController::class, 'createGroup'])->middleware('is_admin');
Route::post('/admin/get_group_members', [AdminController::class, 'getGroupMembers'])->middleware('is_admin');
Route::post('/admin/add_user_group', [AdminController::class, 'addUserGroup'])->middleware('is_admin');
Route::post('/admin/delete_user_group', [AdminController::class, 'deleteUserGroup'])->middleware('is_admin');
Route::post('/admin/delete_group', [AdminController::class, 'deleteGroup'])->middleware('is_admin');
Route::post('/admin/group_add_point', [AdminController::class, 'groupAddPoint'])->middleware('is_admin');
Route::get('/admin/history', [AdminController::class, 'showHistory'])->middleware('is_admin');
Route::get('/admin/export', [AdminController::class, 'showExport'])->middleware('is_admin');
Route::post('/admin/export_confirm', [AdminController::class, 'confirmExport'])->middleware('is_admin');

// User Pages
Route::get('/profile', [HomeController::class, 'profilePage']);
Route::get('/export', [HomeController::class, 'exportPage']);
Route::post('/user/edit_profile', [HomeController::class, 'saveUpdateProfile']);
Route::get('/my-account', [HomeController::class, 'showAccountPage']);
Route::post('/user/get_account_list', [HomeController::class, 'getAccountList']);
Route::post('/user/send_point', [HomeController::class, 'sendPoint']);
Route::post('/user/export_point', [HomeController::class, 'exportPoint']);



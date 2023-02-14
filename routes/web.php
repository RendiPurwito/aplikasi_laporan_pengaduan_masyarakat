<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::get('/dashboard', function () {
//     return view('Dashboard');
// });

// Route::get('/login', function () {
//     return view('auth.login');
// });

// Route::get('/register', function () {
//     return view('auth.register');
// });

// Auth
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('login')->middleware('guest');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'getregister'])->middleware('guest');
Route::post('/register', [AuthController::class, 'postregister'])->name('register')->middleware('guest');
Route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('forgot.password.get')->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('forgot.password.post')->middleware('guest');
Route::get('/reset-password/{token}', [AuthController::class, 'getResetPassword'])->name('reset.password.get');
Route::post('/reset-password/{token}', [AuthController::class, 'postResetPassword'])->name('reset.password.post');

// Petugas
Route::get('/admin/dashboard', function () {
    return view('petugas.admin-dashboard');
})->middleware('admin');

Route::get('/dashboard', function () {
    return view('petugas.dashboard');
})->middleware('petugas');
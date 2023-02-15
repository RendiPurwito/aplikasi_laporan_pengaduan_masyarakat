<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\MasyarakatController;

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
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('forgot.password.get')->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('forgot.password.post')->middleware('guest');
Route::get('/reset-password/{token}', [AuthController::class, 'getResetPassword'])->name('reset.password.get');
Route::post('/reset-password/{token}', [AuthController::class, 'postResetPassword'])->name('reset.password.post');

// Petugas & Admin
Route::prefix('petugas')->group(function (){
    // Petugas
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    })->name('petugas.dashboard')->middleware('petugas');

    // Admin
    Route::prefix('admin')->group(function (){
        Route::get('/dashboard', function () {
            return view('admin.admin-dashboard');
        })->name('admin.dashboard')->middleware('admin');
        
        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('admin.masyarakat.index');
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('admin.pengaduan.index');
        Route::get('/petugas', [PetugasController::class, 'index'])->name('admin.petugas.index');
        Route::get('/tanggapan', [TanggapanController::class, 'index'])->name('admin.tanggapan.index');
    });
});


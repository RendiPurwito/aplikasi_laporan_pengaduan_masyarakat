<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\DashboardController;

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

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.get');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.get')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.post')->middleware('guest');
Route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('forgot.password.get')->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('forgot.password.post')->middleware('guest');
Route::get('/reset-password/{token}', [AuthController::class, 'getResetPassword'])->name('reset.password.get');
Route::post('/reset-password/{token}', [AuthController::class, 'postResetPassword'])->name('reset.password.post');

// Masyarakat Routes
Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan/feedback', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan/feedback', function () {
    return view('Masyarakat.feedback');
});
Route::get('/pengaduan/list', [PengaduanController::class, 'list'])->name('pengaduan.list');
Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
Route::post('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');



// Petugas & Admin
Route::prefix('petugas')->group(function (){
    // Petugas
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('petugas.dashboard')->middleware('petugas');

    // CRUD Pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{id}/pdf', [PengaduanController::class, 'pdf'])->name('pengaduan.pdf');
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.delete')->middleware('admin');

    // Tanggapan
    Route::get('/tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index');
    Route::get('/tanggapan/create/{id}', [TanggapanController::class, 'create'])->name('tanggapan.create');
    Route::post('/tanggapan', [TanggapanController::class, 'store'])->name('tanggapan.store');
    Route::get('/tanggapan/{id}/edit', [TanggapanController::class, 'edit'])->name('tanggapan.edit');
    Route::post('/tanggapan/{id}', [TanggapanController::class, 'update'])->name('tanggapan.update');
    Route::delete('/tanggapan/{id}', [TanggapanController::class, 'destroy'])->name('tanggapan.delete');
    Route::get('/tanggapan/{id}/pdf', [TanggapanController::class, 'pdf'])->name('tanggapan.pdf');

    // Admin
    Route::prefix('admin')->group(function (){

        // Admin registration
        Route::get('/register', [AuthController::class, 'showAdminRegisterForm'])->name('admin.register.get')->middleware('guest');
        Route::post('/registered', [AuthController::class, 'adminRegister'])->name('admin.register.post')->middleware('guest');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('admin');

        // CRUD Masyarakat
        Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('admin.masyarakat.index');
        Route::get('/masyarakat/{id}/edit', [MasyarakatController::class, 'edit'])->name('admin.masyarakat.edit')->middleware('admin');
        Route::post('/masyarakat/{id}', [MasyarakatController::class, 'update'])->name('admin.masyarakat.update')->middleware('admin');
        Route::delete('/masyarakat/{id}', [MasyarakatController::class, 'destroy'])->name('admin.masyarakat.delete')->middleware('admin');

        // CRUD Petugas
        Route::get('/petugas', [PetugasController::class, 'index'])->name('admin.petugas.index');
        Route::get('/petugas/create', [PetugasController::class, 'create'])->name('admin.petugas.create');
        Route::post('/petugas', [PetugasController::class, 'store'])->name('admin.petugas.store')->middleware('admin');
        Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('admin.petugas.edit')->middleware('admin');
        Route::post('/petugas/{id}', [PetugasController::class, 'update'])->name('admin.petugas.update')->middleware('admin');
        Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('admin.petugas.delete')->middleware('admin');
    });
});


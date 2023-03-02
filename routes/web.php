<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\MasyarakatController;

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

//! Auth
    //! Login Form 
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.get');

    //! Login 
    Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');

    //! Logout
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    //! Register Form
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.get')->middleware('guest');

    //! Register
    Route::post('/register', [AuthController::class, 'register'])->name('register.post')->middleware('guest');

    //! Forgot Password Form
    Route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('forgot.password.get')->middleware('guest');

    //! Forgot Password 
    Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('forgot.password.post')->middleware('guest');

    //! Reset Password Form
    Route::get('/reset-password/{token}', [AuthController::class, 'getResetPassword'])->name('reset.password.get');

    //! Reset Password
    Route::post('/reset-password/{token}', [AuthController::class, 'postResetPassword'])->name('reset.password.post');

//! Masyarakat Routes
    //! Create
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create')->middleware('masyarakat');
    
    //! Store
    Route::post('/pengaduan/feedback', [PengaduanController::class, 'store'])->name('pengaduan.store')->middleware('masyarakat');
    
    //! Feedback
    Route::get('/pengaduan/feedback', function () {
        return view('Masyarakat.feedback');
    })->middleware('masyarakat');
    
    //! List pengaduan
    Route::get('/pengaduan/list', [PengaduanController::class, 'list'])->name('pengaduan.list')->middleware('masyarakat');
    
    //! Edit
    Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit')->middleware('masyarakat');
    
    //! Update
    Route::post('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update')->middleware('masyarakat');



//! Petugas & Admin Routes
Route::prefix('petugas')->group(function (){
    //! Petugas
        //! Dashboard
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('petugas.dashboard')->middleware('petugas');

    //! CRUD Pengaduan
        //! Index 
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index')->middleware('petugas.admin');

        //! Delete
        Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.delete')->middleware('petugas.admin');

        //! Verifikasi
        Route::get('/pengaduan/{id}/verifikasi', [PengaduanController::class, 'verify'])->name('pengaduan.verifikasi.get')->middleware('petugas.admin');

        //! Diverifikasi
        Route::post('/pengaduan/{id}', [PengaduanController::class, 'verified'])->name('pengaduan.verifikasi.post')->middleware('petugas.admin');

        //! Detail
        Route::get('/pengaduan/{id}/detail', [PengaduanController::class, 'detail'])->name('pengaduan.detail')->middleware('petugas.admin');

        //! PDF
        Route::get('/pengaduan/{id}/pdf', [PengaduanController::class, 'pdf'])->name('pengaduan.pdf')->middleware('petugas.admin');


    //! Tanggapan
        //! Index
        Route::get('/tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index')->middleware('petugas.admin');

        //! Create
        Route::get('/tanggapan/create/{id}', [TanggapanController::class, 'create'])->name('tanggapan.create')->middleware('petugas.admin');

        //! Store
        Route::post('/tanggapan', [TanggapanController::class, 'store'])->name('tanggapan.store')->middleware('petugas.admin');

        //! Detail
        Route::get('/tanggapan/{id}/detail', [TanggapanController::class, 'detail'])->name('tanggapan.detail')->middleware('petugas.admin');

        //! PDF
        Route::get('/tanggapan/{id}/pdf', [TanggapanController::class, 'pdf'])->name('tanggapan.pdf')->middleware('admin');

    //! Admin Routes
    Route::prefix('admin')->group(function (){

        //! Admin registration
            //! Register Form
            Route::get('/register', [AuthController::class, 'showAdminRegisterForm'])->name('admin.register.get')->middleware('guest');

            //! Register
            Route::post('/registered', [AuthController::class, 'adminRegister'])->name('admin.register.post')->middleware('guest');

        //! Dashboard
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('admin');

        //! CRUD Masyarakat
            //! Index 
            Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('admin.masyarakat.index')->middleware('admin');

            //! Edit
            Route::get('/masyarakat/{id}/edit', [MasyarakatController::class, 'edit'])->name('admin.masyarakat.edit')->middleware('admin');

            //! Update
            Route::post('/masyarakat/{id}', [MasyarakatController::class, 'update'])->name('admin.masyarakat.update')->middleware('admin');

            //! Delete
            Route::delete('/masyarakat/{id}', [MasyarakatController::class, 'destroy'])->name('admin.masyarakat.delete')->middleware('admin');

        //! CRUD Petugas
            //! Index
            Route::get('/petugas', [PetugasController::class, 'index'])->name('admin.petugas.index')->middleware('admin');

            //! Create
            Route::get('/petugas/create', [PetugasController::class, 'create'])->name('admin.petugas.create')->middleware('admin');

            //! Store
            Route::post('/petugas', [PetugasController::class, 'store'])->name('admin.petugas.store')->middleware('admin');

            //! Edit
            Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('admin.petugas.edit')->middleware('admin');

            //! Update
            Route::post('/petugas/{id}', [PetugasController::class, 'update'])->name('admin.petugas.update')->middleware('admin');

            //! Delete
            Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('admin.petugas.delete')->middleware('admin');
    });
});


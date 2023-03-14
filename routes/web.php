<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\MasyarakatController;
use App\Http\Controllers\Petugas\UserPetugasController;
use App\Http\Controllers\Masyarakat\UserMasyarakatController;

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

    //! Forgot Password Form
    Route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('forgot.password.get')->middleware('guest');

    //! Forgot Password 
    Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('forgot.password.post')->middleware('guest');

    //! Reset Password Form
    Route::get('/reset-password/{token}', [AuthController::class, 'getResetPassword'])->name('reset.password.get');

    //! Reset Password
    Route::post('/reset-password/{token}', [AuthController::class, 'postResetPassword'])->name('reset.password.post');

//! Masyarakat Routes
    //! Auth
        //! Login Form 
        Route::get('/login', [UserMasyarakatController::class, 'formLogin'])->name('form-login');

        //! Login 
        Route::post('/login', [UserMasyarakatController::class, 'login'])->name('login')->middleware('guest');

        //! Logout
        Route::get('/logout',[UserMasyarakatController::class,'logout'])->name('logout');

        //! Register Form
        Route::get('/register', [UserMasyarakatController::class, 'formRegister'])->name('form-register')->middleware('guest');

        //! Register
        Route::post('/register', [UserMasyarakatController::class, 'register'])->name('register')->middleware('guest');

    //! Home page
    Route::get('/', [UserMasyarakatController::class, 'home'])->name('landing-page');

    Route::middleware(['masyarakat'])->group(function () {
        //! Form Laporan
        Route::get('/form-laporan', [UserMasyarakatController::class, 'formLaporan'])->name('form-laporan')->middleware('masyarakat');
        
        //! Lapor
        Route::post('/feedback', [UserMasyarakatController::class, 'lapor'])->name('simpan-laporan')->middleware('masyarakat');
        
        //! Feedback
        Route::get('/feedback', function () {
            return view('User Masyarakat.feedback');
        })->name('feedback')->middleware('masyarakat');
        
        //! List pengaduan
        Route::get('/laporan-saya', [UserMasyarakatController::class, 'myLaporan'])->name('laporan-saya')->middleware('masyarakat');
    });


//! User Admin & Petugas
Route::prefix('admin')->group(function (){

    //! Auth
        //! Login Form 
        Route::get('/', [UserPetugasController::class, 'formLogin'])->name('admin.form-login');

        //! Login 
        Route::post('/login', [UserPetugasController::class, 'login'])->name('admin.login')->middleware('guest');

        //! Logout
        Route::get('/logout',[UserPetugasController::class,'logout'])->name('admin.logout');

        //! Register Form
        Route::get('/register', [UserPetugasController::class, 'formRegister'])->name('admin.form-register')->middleware('guest');

        //! Register
        Route::post('/registered', [UserPetugasController::class, 'register'])->name('admin.register')->middleware('guest');

    //! User Admin
    Route::middleware(['admin'])->group(function () {
        //! Dashboard
        Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

        //! Data Masyarakat
            //! Index 
            Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('admin.masyarakat.index');

        //! Data Petugas
            //! Index
            Route::get('/petugas', [PetugasController::class, 'index'])->name('admin.petugas.index');

            //! Create
            Route::get('/petugas/create', [PetugasController::class, 'create'])->name('admin.petugas.create');

            //! Store
            Route::post('/petugas', [PetugasController::class, 'store'])->name('admin.petugas.store');

            //! Edit
            Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('admin.petugas.edit');

            //! Update
            Route::post('/petugas/{id}', [PetugasController::class, 'update'])->name('admin.petugas.update');

            //! Delete
            Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('admin.petugas.delete');
    });
    
    //! User Petugas
    Route::middleware(['petugas'])->group(function () {
        //! Dashboard
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('petugas.dashboard')->middleware('petugas');
    });

    Route::middleware(['petugas.admin'])->group(function () {
        //! CRUD Kategori
            //! Index
            Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

            //! Create
            Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');

            //! Store
            Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
            
        //! CRUD Pengaduan
            //! Index 
            Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    
            //! Verifikasi
            Route::post('/pengaduan/{id}/verifikasi', [PengaduanController::class, 'verify'])->name('pengaduan.verifikasi');

            //! Reject
            Route::post('/pengaduan/{id}', [PengaduanController::class, 'reject'])->name('pengaduan.reject');
    
            //! Detail
            Route::get('/pengaduan/{id}/detail', [PengaduanController::class, 'detail'])->name('pengaduan.detail');
        
            //! Generate Laporan 
            Route::get('/generate-laporan/', [PengaduanController::class, 'generate'])->name('pengaduan.generate-laporan');

            //! Export PDF berdasarkan ID
            Route::get('/pengaduan/{id}/pdf', [PengaduanController::class, 'pdfByID'])->name('pengaduan.pdf-id');

            //! Export Pengaduan By Kategori & Tanggal To PDF
            Route::get('/pengaduan/pdf-by-kategori-tanggal/', [PengaduanController::class, 'pdfByKategoriTanggal'])->name('pengaduan.pdf-kategori-tanggal')->middleware('admin');
    
        //! CRUD Tanggapan
            //! Index
            Route::get('/tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index');
    
            //! Create
            Route::get('/pengaduan/{id}', [TanggapanController::class, 'create'])->name('tanggapan.create');
    
            //! Store
            Route::post('/tanggapan/{id}', [TanggapanController::class, 'store'])->name('tanggapan.store');
    
            //! Detail
            Route::get('/tanggapan/{id}/detail', [TanggapanController::class, 'detail'])->name('tanggapan.detail');
        });
});


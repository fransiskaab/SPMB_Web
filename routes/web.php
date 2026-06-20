<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PaketPendaftaranController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\TransaksiPembayaranController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Public Landing Page Routes (Deactivated Home Page)
Route::get('/', [RegisterController::class, 'showRegister'])->name('home');
Route::get('/profil', [LandingPageController::class, 'profile'])->name('public.profile');
Route::get('/fasilitas', [LandingPageController::class, 'facilities'])->name('public.facilities');
Route::get('/informasi-pendaftaran', [LandingPageController::class, 'info'])->name('public.info');
Route::get('/paket-pendaftaran', [LandingPageController::class, 'packages'])->name('public.packages');
Route::get('/kontak', [LandingPageController::class, 'contact'])->name('public.contact');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Student Dashboard Routes
Route::middleware(['auth', 'role:calon_murid'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [StudentDashboardController::class, 'profile'])->name('profile');
    Route::post('/profile', [StudentDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/pendaftaran', [StudentDashboardController::class, 'pendaftaran'])->name('pendaftaran');
    Route::post('/pendaftaran', [StudentDashboardController::class, 'submitPendaftaran'])->name('pendaftaran.submit');
    Route::get('/pembayaran', [StudentDashboardController::class, 'pembayaran'])->name('pembayaran');
    Route::post('/pembayaran', [StudentDashboardController::class, 'submitPembayaran'])->name('pembayaran.submit');
    Route::get('/pengumuman', [StudentDashboardController::class, 'pengumuman'])->name('pengumuman');
});

// Admin Dashboard Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data Kelas
    Route::resource('kelas', KelasController::class);

    // Master Data Paket Pendaftaran
    Route::resource('paket', PaketPendaftaranController::class);

    // Verifikasi Pendaftaran Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::post('/siswa/{siswa}/status', [SiswaController::class, 'updateStatus'])->name('siswa.updateStatus');

    // Verifikasi Pembayaran
    Route::get('/pembayaran', [TransaksiPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/{transaksi}', [TransaksiPembayaranController::class, 'show'])->name('pembayaran.show');
    Route::post('/pembayaran/{transaksi}/verify', [TransaksiPembayaranController::class, 'verify'])->name('pembayaran.verify');

    // User Management (Admin, Staff, Operator CRUD)
    Route::resource('users', UserController::class);
});


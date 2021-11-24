<?php

use App\Models\Buku;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Kategori;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\DetailBukuController;
use App\Http\Controllers\PinjamBukuController;
use App\Http\Controllers\Admin\PinjamController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ThumbnailController;
use App\Http\Controllers\Auth\DaftarUserController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\LupaPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('semua-buku', [IndexController::class, 'semuabuku'])->name('semuabuku');
Route::get('kategori/{kategori:kategori}', [IndexController::class, 'showkategori'])->name('kategori');
Route::get('tampil/{kategori:kategori}', [IndexController::class, 'tampil'])->name('tampil');
Route::get('/lupa-password', [LupaPasswordController::class,'index']);
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/detail-buku/{kategori:kategori}/{buku:slug}', [DetailBukuController::class, 'index'])->name('detail-buku');
Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
        return redirect('/login');
    })->middleware(['signed'])->name('verification.verify');

Route::middleware(['anggota'])->group(function () {
    Route::resource('/login', LoginUserController::class);
    Route::resource('/daftar', DaftarUserController::class);
});


Route::middleware(['guest'])->group(function () {
    Route::resource('/login-admin', LoginController::class);
});

Route::middleware(['useranggota'])->group(function () {
    Route::get('logoutuser/{anggota:id}', [IndexController::class, 'logoutuser'])->name('logoutuser');
    Route::get('pinjambuku/{buku:slug}', [PinjamBukuController::class, 'pinjambuku'])->name('pinjambuku');
    Route::post('pinjambuku/{buku:id}', [PinjamBukuController::class, 'pinjam'])->name('pinjam');
    Route::get('pinjamberhasil/{pinjam:email}/{anggota:id}', [PinjamBukuController::class, 'pinjamberhasil'])->name('pinjamberhasil');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile/{anggota:id}', [ProfileController::class, 'ubahprofil'])->name('profil');
    Route::get('pinjaman', [ProfileController::class, 'pinjaman'])->name('pinjamanuser');
    Route::post('pinjamanuser/{pinjaman:id}', [ProfileController::class, 'pinjamus'])->name('pinjamanus');
    Route::get('aktifitas', [ProfileController::class, 'aktifitas'])->name('aktifitas');
    Route::post('aktifitas/{aktifitas:id}', [ProfileController::class, 'hapusaktifitas'])->name('aktifitasus');
    Route::get('cetakpinjamanuser/{anggota:email}/{pinjaman:id}', [CetakController::class, 'cetakpinjamanuser'])->name('cetakpinjamanuser');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index']);
    Route::get('admin/anggota', [DashboardController::class, 'anggota'])->name('anggota');
    Route::post('admin/{anggota:id}/anggota', [DashboardController::class, 'delete'])->name('anggotadelete');
    Route::post('admin/anggota/{anggota:id}', [DashboardController::class, 'update'])->name('anggotaupdate');
    Route::middleware(['adminrole'])->group(function () {
        Route::resource('admin/petugas', PetugasController::class);
    });
    Route::get('cetakpinjaman/{anggota:email}/{pinjaman:id}', [CetakController::class, 'cetakpinjaman'])->name('cetakpinjaman');
    Route::get('cetakdata/', [CetakController::class, 'cetakdata'])->name('cetakdata');
    Route::resource('admin/buku', BukuController::class);
    Route::resource('admin/kategori', KategoriController::class);
    Route::resource('admin/pinjam', PinjamController::class);
    Route::resource('admin/thumbnail', ThumbnailController::class);
    Route::get('admin/logout', [DashboardController::class, 'logout'])->name('logout');
});


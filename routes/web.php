<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;

use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;

Route::resource('/admin/jenis-hewan', JenisHewanController::class)
     ->names('admin.jenis-hewan');

Route::resource('/admin/pemilik', PemilikController::class)
     ->names('admin.pemilik');
Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');
Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/admin/jenis-hewan', [JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
Route::get('/admin/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');

//Daftar Ras Hewan
Route::get('/admin/ras-hewan', [RasHewanController::class, 'index'])->name('admin.ras-hewan.index');
//Daftar Kategori
Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
//Daftar Kategori klinis
Route::get('/admin/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
//Daftar Kode Tindakan terapi
Route::get('/admin/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');
//Daftar pet
Route::get('/admin/pet', [PetController::class, 'index'])->name('admin.pet.index');
//Daftar Role
Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.role.index');
//Daftar User dengan Rolenya
Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
Route::get('/admin/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('admin.pemilik.index');


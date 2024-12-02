<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\PegawaiController;
use App\Http\Controllers\Owner\TransaksiController;
use App\Http\Controllers\Owner\KelolaBarangController;

use App\Http\Controllers\Pegawai\DashboardPegawaiController;
use App\Http\Controllers\Pegawai\TransaksiPegawaiController;
use App\Http\Controllers\Pegawai\KelolaBarangPegawaiController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BarangController::class, 'index'])->name('barang.index');

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');



Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');

    Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::get('pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

    Route::get('barang', [KelolaBarangController::class, 'index'])->name('owner.barang.index');
    Route::get('barang/create', [KelolaBarangController::class, 'create'])->name('owner.barang.create');
    Route::post('barang', [KelolaBarangController::class, 'store'])->name('owner.barang.store');
    Route::get('barang/{barang}/edit', [KelolaBarangController::class, 'edit'])->name('owner.barang.edit');
    Route::put('barang/{barang}', [KelolaBarangController::class, 'update'])->name('owner.barang.update');
    Route::delete('barang/{barang}', [KelolaBarangController::class, 'destroy'])->name('owner.barang.destroy');
    
    Route::get('transaksi/dashboard', [TransaksiController::class, 'dashboard'])->name('owner.transaksi.dashboard');
    Route::get('transaksi/masuk', [TransaksiController::class, 'masuk'])->name('owner.transaksi.masuk');
    Route::get('transaksi/keluar', [TransaksiController::class, 'keluar'])->name('owner.transaksi.keluar');
    Route::get('transaksi/create-jual', [TransaksiController::class, 'createJual'])->name('owner.transaksi.create-jual');
    Route::get('transaksi/create-beli', [TransaksiController::class, 'createBeli'])->name('owner.transaksi.create-beli');
    Route::post('transaksi', [TransaksiController::class, 'store'])->name('owner.transaksi.store');
    Route::get('transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('owner.transaksi.edit');
    Route::put('transaksi/{id}', [TransaksiController::class, 'update'])->name('owner.transaksi.update');
    Route::delete('transaksi/{id}', [TransaksiController::class, 'destroy'])->name('owner.transaksi.destroy');
    Route::get('transaksi/{id}/print', [TransaksiController::class, 'print'])->name('owner.transaksi.print');

});


Route::prefix('pegawai')->middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('/dashboard', [DashboardPegawaiController::class, 'index'])->name('pegawai.dashboard');

    Route::get('barang', [KelolaBarangPegawaiController::class, 'index'])->name('pegawai.barang.index');
    Route::get('barang/create', [KelolaBarangPegawaiController::class, 'create'])->name('pegawai.barang.create');
    Route::post('barang', [KelolaBarangPegawaiController::class, 'store'])->name('pegawai.barang.store');
    Route::get('barang/{barang}/edit', [KelolaBarangPegawaiController::class, 'edit'])->name('pegawai.barang.edit');
    Route::put('barang/{barang}', [KelolaBarangPegawaiController::class, 'update'])->name('pegawai.barang.update');
    Route::delete('barang/{barang}', [KelolaBarangPegawaiController::class, 'destroy'])->name('pegawai.barang.destroy');
    
    Route::get('transaksi/dashboard', [TransaksiPegawaiController::class, 'dashboard'])->name('pegawai.transaksi.dashboard');
    Route::get('transaksi/masuk', [TransaksiPegawaiController::class, 'masuk'])->name('pegawai.transaksi.masuk');
    Route::get('transaksi/keluar', [TransaksiPegawaiController::class, 'keluar'])->name('pegawai.transaksi.keluar');
    Route::get('transaksi/create-jual', [TransaksiPegawaiController::class, 'createJual'])->name('pegawai.transaksi.create-jual');
    Route::get('transaksi/create-beli', [TransaksiPegawaiController::class, 'createBeli'])->name('pegawai.transaksi.create-beli');
    Route::post('transaksi', [TransaksiPegawaiController::class, 'store'])->name('pegawai.transaksi.store');
    Route::get('transaksi/{id}/edit', [TransaksiPegawaiController::class, 'edit'])->name('pegawai.transaksi.edit');
    Route::put('transaksi/{id}', [TransaksiPegawaiController::class, 'update'])->name('pegawai.transaksi.update');
    Route::delete('transaksi/{id}', [TransaksiPegawaiController::class, 'destroy'])->name('pegawai.transaksi.destroy');
    Route::get('transaksi/{id}/print', [TransaksiPegawaiController::class, 'print'])->name('pegawai.transaksi.print');

});

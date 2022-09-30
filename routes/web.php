<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KostumerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AutentikasiController::class, 'login'])->name('login');
Route::post('/login', [AutentikasiController::class, 'postLogin'])->name('post.login');

Route::middleware('auth.super-admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('worker')->group(function () {
        Route::get('/', [WorkerController::class, 'index'])->name('worker');
        Route::get('/detail/{id}', [WorkerController::class, 'detail'])->name('worker.detail');
    });

    Route::prefix('supplier')->group(function(){
        Route::get('/', [SupplierController::class, 'index'])->name('supplier');
        Route::get('/detail/{id}', [SupplierController::class, 'detail'])->name('supplier.detail');
    });

    Route::prefix('kostumer')->group(function(){
        Route::get('/', [KostumerController::class, 'index'])->name('kostumer');
        Route::get('/detail/{id}', [KostumerController::class, 'detail'])->name('kostumer.detail');
    });

    Route::prefix('barang')->group(function(){
        Route::get('/', [BarangController::class, 'index'])->name('barang');
        Route::get('/detail/{id}', [BarangController::class, 'detail'])->name('barang.detail');
    });

    Route::prefix('master')->group(function () {
        Route::get('/tipe_user', [AttributeController::class, 'tipeUser'])->name('tipe_user');
        Route::get('/satuan', [AttributeController::class, 'satuan'])->name('satuan');
    });

    Route::prefix('payment')->group(function () {
        Route::get('/', [PembayaranController::class, 'index'])->name('tipe_pembayaran');
    });

});

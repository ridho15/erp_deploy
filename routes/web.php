<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangCustomerController;
use App\Http\Controllers\DaftarTugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormMasterController;
use App\Http\Controllers\FormPekerjaanController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KondisiController;
use App\Http\Controllers\KostumerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ManagementTugasController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PinjamMeminjamController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TipeBarangController;
use App\Http\Controllers\WebConfigurationController;
use App\Http\Controllers\WorkerController;
use App\Models\Quotation;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::prefix('testing')->group(function () {
    Route::get('/', function () {
        $quotation = Quotation::first();
        $data['quotation'] = $quotation;

        return view('mail.send-quotation', $data);
    })->name('testing');
    Route::get('/export-pdf', [DashboardController::class, 'exportPdf'])->name('testing.export-pdf');
    Route::get('/view-mail', function () {
        $data['quotation'] = Quotation::find(3);

        return view('mail.send-quotation', $data);
    });
});

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/login', [AutentikasiController::class, 'login'])->name('login');
Route::post('/login', [AutentikasiController::class, 'postLogin'])->name('post.login');
Route::get('/logout', [AutentikasiController::class, 'logout'])->name('logout');

Route::middleware('auth.user')->group(function () {
    Route::middleware('auth.pekerja')->group(function(){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('pekerja.dashboard');

        Route::prefix('daftar-tugas')->group(function () {
            Route::get('/', [DaftarTugasController::class, 'index'])->name('daftar-tugas');
            Route::get('/kelola/{id}', [DaftarTugasController::class, 'kelola'])->name('daftar-tugas.kelola');
            Route::get('/ambil/{id}', [DaftarTugasController::class, 'ambil'])->name('daftar-tugas.ambil');
            Route::get('/mulai/{id}', [DaftarTugasController::class, 'mulai'])->name('daftar-tugas.mulai');
        });
    });

    Route::prefix('laporan')->group(function(){
        Route::get('/account-payable', [LaporanController::class, 'accountPayable'])->name('laporan.account-payable');
        Route::get('/account-receivable', [LaporanController::class, 'accountReceivable'])->name('laporan.account-receivable');
        Route::get('/kalender', [LaporanController::class, 'kalender'])->name('laporan.kalender');
        Route::get('/spareparts', [LaporanController::class, 'spareparts'])->name('laporan.spareparts');
        Route::get('/stock-opname', [LaporanController::class, 'stockOpname'])->name('laporan.stock-opname');
        Route::get('/log-activity', [LaporanController::class, 'logActivity'])->name('laporan.log-activity');
        Route::get('/grafik-penjualan', [LaporanController::class, 'grafikPenjualan'])->name('laporan.grafik-penjualan');
        Route::get('/profit-pre-order', [LaporanController::class, 'profitPreOrder'])->name('laporan.profit-pre-order');
    });

    Route::middleware('auth.super-admin')->group(function(){
        Route::prefix('form-pekerjaan')->group(function () {
            Route::get('/', [FormPekerjaanController::class, 'index'])->name('form-pekerjaan');
            Route::get('/detail/{id}', [FormPekerjaanController::class, 'detail'])->name('form-pekerjaan.detail');
            Route::get('/pekerjaan-detail/{id}', [FormPekerjaanController::class, 'detailPekerjaan'])->name('form-pekerjaan.pekerjaan-detail');
        });

        Route::prefix('management-tugas')->group(function () {
            Route::get('/', [ManagementTugasController::class, 'index'])->name('management-tugas');
            Route::get('/detail/{id}', [ManagementTugasController::class, 'detail'])->name('management-tugas.detail');
            Route::get('/export/{id}', [ManagementTugasController::class, 'export'])->name('management-tugas.export');
        });

        Route::prefix('project')->group(function () {
            Route::get('/', [ProjectController::class, 'index'])->name('project');
        });

        Route::prefix('form')->group(function () {
            Route::get('/', [FormMasterController::class, 'index'])->name('form');
            Route::get('/detail/{id}', [FormMasterController::class, 'detail'])->name('form.detail');
        });

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('web-config')->group(function () {
            Route::get('/', [WebConfigurationController::class, 'index'])->name('web-config');
        });

        Route::prefix('worker')->group(function () {
            Route::get('/', [WorkerController::class, 'index'])->name('worker');
            Route::get('/detail/{id}', [WorkerController::class, 'detail'])->name('worker.detail');
        });

        Route::prefix('supplier')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('supplier');
            Route::get('/order', [SupplierController::class, 'order'])->name('supplier.order');
            Route::get('/order/payable', [SupplierController::class, 'payable'])->name('supplier-order.payable');
            Route::get('/order/{id}', [SupplierController::class, 'orderDetail'])->name('supplier.order-detail');
            Route::get('/detail/{id}', [SupplierController::class, 'detail'])->name('supplier.detail');
        });

        Route::prefix('quotation')->group(function () {
            Route::get('/', [QuotationController::class, 'index'])->name('quotation');
            Route::get('/detail/{id}', [QuotationController::class, 'detail'])->name('quotation.detail');
            Route::get('/export/{id}', [QuotationController::class, 'export'])->name('quotation.export');
            Route::get('konfirmasi/{id}', [QuotationController::class, 'konfirmasi'])->name('quotation.konfirmasi');
        });

        Route::prefix('kostumer')->group(function () {
            Route::get('/', [KostumerController::class, 'index'])->name('kostumer');
            Route::get('/detail/{id}', [KostumerController::class, 'detail'])->name('kostumer.detail');
            Route::get('/order-detail/{id}', [KostumerController::class, 'orderDetail'])->name('kostumer.order-detail');
        });

        Route::prefix('barang')->group(function () {
            Route::get('/', [BarangController::class, 'index'])->name('barang');
            Route::get('/detail/{id}', [BarangController::class, 'detail'])->name('barang.detail');
        });

        Route::prefix('kategori')->group(function () {
            Route::get('/', [KategoriController::class, 'index'])->name('kategori');
            Route::get('/detail/{id}', [KategoriController::class, 'detail'])->name('kategori.detail');
        });

        Route::prefix('merk')->group(function () {
            Route::get('/', [MerkController::class, 'index'])->name('merk');
            Route::get('/detail/{id}', [MerkController::class, 'detail'])->name('merk.detail');
        });

        Route::prefix('tipe-barang')->group(function () {
            Route::get('/', [TipeBarangController::class, 'index'])->name('tipe-barang');
        });

        Route::prefix('tipe-user')->group(function () {
            Route::get('/', [AttributeController::class, 'tipeUser'])->name('tipe_user');
        });

        Route::prefix('satuan')->group(function () {
            Route::get('/', [AttributeController::class, 'satuan'])->name('satuan');
        });

        Route::prefix('payment')->group(function () {
            Route::get('/', [PembayaranController::class, 'index'])->name('tipe_pembayaran');
        });

        Route::prefix('metode-pembayaran')->group(function () {
            Route::get('/', [MetodePembayaranController::class, 'index'])->name('metode-pembayaran');
        });

        Route::prefix('barang-customer')->group(function(){
            Route::get('/', [BarangCustomerController::class, 'index'])->name('barang-customer');
        });

        Route::prefix('sales')->group(function(){
            Route::get('/', [SalesController::class, 'index'])->name('sales');
        });

        Route::prefix('kondisi')->group(function () {
            Route::get('/', [KondisiController::class, 'index'])->name('kondisi');
        });

        Route::prefix('pekerjaan')->group(function () {
            Route::get('/', [PekerjaanController::class, 'index'])->name('pekerjaan');
        });
    });
    Route::get('profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');


    Route::middleware('auth.admin-gudang')->group(function(){
        Route::prefix('pre-order')->group(function () {
            Route::get('/', [PreOrderController::class, 'index'])->name('pre-order');
            Route::get('/account-receivable', [PreOrderController::class, 'accountReceivable'])->name('pre-order.account-receivable');
            Route::get('/done', [PreOrderController::class, 'done'])->name('pre-order.done');
            Route::get('/detail/{id}', [PreOrderController::class, 'detail'])->name('pre-order.detail');
            Route::get('/invoice/{id}', [PreOrderController::class, 'invoice'])->name('pre-order.invoice');
        });

        Route::prefix('invoice')->group(function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('invoice');
        });

        Route::prefix('pinjam-meminjam')->group(function () {
            Route::get('/', [PinjamMeminjamController::class, 'index'])->name('pinjam-meminjam');
        });

        Route::prefix('inventory')->group(function(){
            Route::get('/', [InventoryController::class, 'index'])->name('inventory');
            Route::get('/stock-opname', [InventoryController::class, 'stockOpname'])->name('inventory.stock-opname');
        });

        Route::prefix('rak')->group(function(){
            Route::get('/', [RakController::class, 'index'])->name('rak');
            Route::get('/detail/{id}', [RakController::class, 'detail'])->name('rak.detail');
        });
    });
});

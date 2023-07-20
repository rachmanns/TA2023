<?php

use App\Http\Controllers\matfaskes\DashboardBarangController;
use App\Http\Controllers\matfaskes\DataBekkesController;
use App\Http\Controllers\matfaskes\DataMatkesController;
use App\Http\Controllers\matfaskes\DetailBekkesController;
use App\Http\Controllers\matfaskes\FaskesController;
use App\Http\Controllers\matfaskes\kegiatan\DashboardKegiatanController;
use App\Http\Controllers\matfaskes\kegiatan\HibahController;
use App\Http\Controllers\matfaskes\kegiatan\PengadaanController;
use App\Http\Controllers\matfaskes\kegiatan\TktmController;
use App\Http\Controllers\matfaskes\VendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('matfaskes')->name('matfaskes.')->group(function () {
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/', [VendorController::class, 'index'])->name('index');
        Route::post('store', [VendorController::class, 'store'])->name('store');
        Route::get('list', [VendorController::class, 'list'])->name('list');
        Route::get('edit/{vendor}', [VendorController::class, 'edit'])->name('edit');
        Route::put('update/{vendor}', [VendorController::class, 'update'])->name('update');
    });

    Route::prefix('pengadaan')->name('pengadaan.')->group(function () {
        Route::get('/', [PengadaanController::class, 'index'])->name('index');
        Route::get('create', [PengadaanController::class, 'create'])->name('create');
        Route::post('store', [PengadaanController::class, 'store'])->name('store');
        Route::get('get/{kode_dipa}/{tahun}', [PengadaanController::class, 'list']);
        Route::get('edit/{kontrak}', [PengadaanController::class, 'edit'])->name('edit');
        Route::put('update/{kontrak}', [PengadaanController::class, 'update'])->name('update');
        Route::get('pdf-kontrak/{file_kontrak}', [PengadaanController::class, 'pdf_kontrak'])->name('pdf_kontrak');
        Route::get('edit-lapju/{kontrak}', [PengadaanController::class, 'edit_lapju'])->name('edit_lapju');
        Route::put('update-lapju/{kontrak}', [PengadaanController::class, 'update_lapju'])->name('update_lapju');
        Route::delete('{kontrak}', [PengadaanController::class, 'destroy']);

        Route::get('daftar-barang/{kontrak}', [PengadaanController::class, 'daftar_barang'])->name('daftar_barang');
        Route::get('download', [PengadaanController::class, 'download']);
        Route::get('download-edit/{id_barang_masuk}', [PengadaanController::class, 'download_edit']);
        Route::post('daftar-barang/excel/import', [PengadaanController::class, 'excel_import'])->name('daftar_barang.excel_import');
        Route::post('daftar-barang/excel/store', [PengadaanController::class, 'excel_store'])->name('daftar_barang.excel_store');
        Route::post('edit-excel-brg', [PengadaanController::class, 'edit_excel_brg']);
        Route::post('update-excel-brg', [PengadaanController::class, 'update_excel_brg']);
        Route::get('daftar-barang/list-tujuan/{id_kontrak}/{kode_barang}/{id_rencana}', [PengadaanController::class, 'list_tujuan'])->name('daftar_barang.list_tujuan');
        Route::delete('daftar-barang/destroy-rencana-pengeluaran/{id_rencana_pengeluaran}', [PengadaanController::class, 'destroy_rencana_pengeluaran']);
    });

    Route::prefix('tktm')->name('tktm.')->group(function () {
        Route::get('/', [TktmController::class, 'index'])->name('index');
        Route::post('list', [TktmController::class, 'list'])->name('list');
        Route::get('pdf/{file_kontrak_tktm}', [TktmController::class, 'pdf_kontrak_tktm'])->name('pdf_kontrak_tktm');
    });

    Route::prefix('hibah')->name('hibah.')->group(function () {
        Route::get('/', [HibahController::class, 'index'])->name('index');
        Route::get('create', [HibahController::class, 'create'])->name('create');
        Route::post('store', [HibahController::class, 'store'])->name('store');
        Route::get('list/{from_date}/{to_date}', [HibahController::class, 'list'])->name('list');
        Route::post('list', [HibahController::class, 'list'])->name('list');
        Route::get('edit/{ba_hibah}', [HibahController::class, 'edit'])->name('edit');
        Route::put('update/{ba_hibah}', [HibahController::class, 'update'])->name('update');
        Route::get('pdf/{file_ba_hibah}', [HibahController::class, 'pdf_ba_hibah'])->name('pdf_ba_hibah');

        Route::get('daftar-barang/{ba_hibah}', [HibahController::class, 'daftar_barang'])->name('daftar_barang');
        Route::post('daftar-barang/excel/import', [HibahController::class, 'excel_import'])->name('daftar_barang.excel_import');
        Route::post('daftar-barang/excel/store', [HibahController::class, 'excel_store'])->name('daftar_barang.excel_store');
        Route::get('daftar-barang/list-tujuan/{id_barang_masuk}/{kode_barang}/{id_rencana}', [HibahController::class, 'list_tujuan'])->name('daftar_barang.list_tujuan');
        Route::delete('daftar-barang/destroy-rencana-pengeluaran/{id_rencana_pengeluaran}', [HibahController::class, 'destroy_rencana_pengeluaran']);
    });

    Route::prefix('data-matkes')->name('data_matkes.')->group(function () {
        Route::get('/', [DataMatkesController::class, 'index'])->name('index');
        Route::post('list', [DataMatkesController::class, 'list'])->name('list');
        Route::get('detail/{id_barang_masuk}', [DataMatkesController::class, 'detail']);
    });

    Route::prefix('dashboard-kegiatan')->name('dashboard_kegiatan.')->group(function () {
        Route::get('/', [DashboardKegiatanController::class, 'index'])->name('index');
        // Route::get('list', [DataMatkesController::class, 'list'])->name('list');
    });

    Route::prefix('faskes')->name('faskes.')->group(function () {
        Route::get('/', [FaskesController::class, 'index'])->name('index');
        Route::get('list', [FaskesController::class, 'list'])->name('list');
        Route::get('kelola/{id}', 'App\Http\Controllers\YankesinController@kelola_fasilitas')->name('kelola');
        Route::post('update-keterangan/{id}', [FaskesController::class, 'update_keterangan']);
    });

    Route::prefix('dashboard-barang')->group(function () {
        Route::get('/grafik-alkes', [DashboardBarangController::class, 'grafik_alkes']);
        Route::get('/grafik-bekkes', [DashboardBarangController::class, 'grafik_bekkes']);
        Route::post('/berjalan', [DashboardBarangController::class, 'berjalan']);
        Route::post('/lampau', [DashboardBarangController::class, 'lampau']);
        Route::get('/tambah_isi_bekkes', function () {
        });
    });

    Route::post('data-bekkes/get', [DataBekkesController::class, 'get']);
    Route::post('data-bekkes/update-foto/{data_bekkes}', [DataBekkesController::class, 'update_foto']);
    Route::post('data-bekkes/preview', [DataBekkesController::class, 'preview']);
    Route::post('data-bekkes/store-import', [DataBekkesController::class, 'store_import']);
    Route::resource('data-bekkes', DataBekkesController::class)->parameters([
        'data-bekkes' => 'data_bekkes'
    ]);

    Route::prefix('detail-bekkes')->group(function () {
        Route::get('create/{id_data_bekkes}', [DetailBekkesController::class, 'create']);
        Route::post('store', [DetailBekkesController::class, 'store']);
        Route::post('get', [DetailBekkesController::class, 'get']);
        Route::get('edit/{detail_bekkes}', [DetailBekkesController::class, 'edit']);
        Route::put('{detail_bekkes}', [DetailBekkesController::class, 'update']);
        Route::delete('/{detail_bekkes}', [DetailBekkesController::class, 'destroy']);
        Route::post('/preview', [DetailBekkesController::class, 'preview']);
        Route::post('/store-excel', [DetailBekkesController::class, 'store_excel']);
    });
});

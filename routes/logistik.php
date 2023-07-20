<?php

use App\Http\Controllers\bidum\logistik\AsetMasukController;
use App\Http\Controllers\bidum\logistik\DaftarBarangController;
use App\Http\Controllers\bidum\logistik\DashboardLogistikController;
use App\Http\Controllers\bidum\logistik\HibahKeluarController;
use App\Http\Controllers\bidum\logistik\HibahMasukController;
use App\Http\Controllers\bidum\logistik\PemakaianController;
use App\Http\Controllers\bidum\logistik\PengadaanMasukController;
use App\Http\Controllers\bidum\logistik\PersediaanMasukController;
use App\Http\Controllers\bidum\logistik\ReportController;
use App\Http\Controllers\bidum\logistik\StrukturOrganisasiLogistikController;
use App\Http\Controllers\bidum\logistik\TransaksiKeluarController;
use App\Http\Controllers\bidum\logistik\TransaksiMasukController;
use App\Http\Controllers\bidum\logistik\TransferKeluarController;
use App\Http\Controllers\bidum\logistik\TransferMasukController;
use Illuminate\Support\Facades\Route;

Route::prefix('bidum')->name('bidum.')->group(function () {
    Route::prefix('logistik')->name('logistik.')->group(function () {
        Route::get('/', [DashboardLogistikController::class, 'index'])->name('index');

        Route::get('chart-aset-masuk/{from}/{to}', [DashboardLogistikController::class, 'chart_aset_masuk'])->name('chart_aset_masuk');
        Route::get('chart-persediaan-masuk/{from}/{to}', [DashboardLogistikController::class, 'chart_persediaan_masuk'])->name('chart_persediaan_masuk');
        Route::get('chart-aset-keluar/{from}/{to}', [DashboardLogistikController::class, 'chart_aset_keluar'])->name('chart_aset_keluar');
        Route::get('chart-persediaan-keluar/{from}/{to}', [DashboardLogistikController::class, 'chart_persediaan_keluar'])->name('chart_persediaan_keluar');
        // Route::get('chart-aset-masuk/{month_year}', [DashboardLogistikController::class, 'chart_aset_masuk'])->name('chart_aset_masuk');
        // Route::get('chart-persediaan-masuk/{month_year}', [DashboardLogistikController::class, 'chart_persediaan_masuk'])->name('chart_persediaan_masuk');
        // Route::get('chart-aset-keluar/{month_year}', [DashboardLogistikController::class, 'chart_aset_keluar'])->name('chart_aset_keluar');
        // Route::get('chart-persediaan-keluar/{month_year}', [DashboardLogistikController::class, 'chart_persediaan_keluar'])->name('chart_persediaan_keluar');
        Route::post('export-master-aset', [DashboardLogistikController::class, 'export_master_aset'])->name('export_master_aset');
        // Route::post('export-laporan', [DashboardLogistikController::class, 'export_laporan']);
        Route::get('export-laporan/{id_kategori}', [DashboardLogistikController::class, 'export_laporan']);


        Route::get('aset-masuk', [TransaksiMasukController::class, 'index_aset'])->name('aset_masuk.index');
        Route::get('persediaan-masuk', [TransaksiMasukController::class, 'index_persediaan'])->name('persediaan_masuk.index');

        Route::post('transfer-masuk/store-transfer/{jenis_tktm}', [TransferMasukController::class, 'store_transfer'])->name('transfer_masuk.store_transfer');
        Route::get('transfer-masuk/list-transfer/{from_date}/{to_date}/{jenis_tktm}', [TransferMasukController::class, 'list_transfer'])->name('transfer_masuk.list_transfer');
        Route::get('transfer-masuk/edit-transfer/{in_tktm}', [TransferMasukController::class, 'edit_transfer'])->name('transfer_masuk.edit_transfer');
        Route::put('transfer-masuk/update-transfer/{in_tktm}', [TransferMasukController::class, 'update_transfer'])->name('transfer_masuk.update_transfer');
        Route::get('transfer-masuk/pdf-rth-tm/{file_rth_tm}', [TransferMasukController::class, 'pdf_rth_tm'])->name('transfer_masuk.pdf_rth_tm');
        Route::get('transfer-masuk/pdf-rth-tk/{file_rth_tk}', [TransferMasukController::class, 'pdf_rth_tk'])->name('transfer_masuk.pdf_rth_tk');
        Route::get('transfer-masuk/pdf-kontrak-tktm/{file_kontrak_tktm}', [TransferMasukController::class, 'pdf_kontrak_tktm'])->name('transfer_masuk.pdf_kontrak_tktm');
        Route::delete('transfer-masuk/{in_tktm}', [TransferMasukController::class, 'destroy']);
        // Route::get('transfer-masuk/input-barang', [AsetMasukController::class, 'input_barang'])->name('transfer_masuk.input_barang');


        Route::get('pengadaan-masuk/list-pengadaan/{from_date}/{to_date}/{kode_dipa}/{prefix_kontrak}', [PengadaanMasukController::class, 'list_pengadaan'])->name('pengadaan_masuk.list_pengadaan');
        Route::get('pengadaan-masuk/edit-pengadaan/{in_pengadaan}', [PengadaanMasukController::class, 'edit_pengadaan'])->name('pengadaan_masuk.edit_pengadaan');
        Route::put('pengadaan-masuk/update-pengadaan/{in_pengadaan}', [PengadaanMasukController::class, 'update_pengadaan'])->name('pengadaan_masuk.update_pengadaan');
        Route::get('pengadaan-masuk/pdf-rth/{file_rth}', [PengadaanMasukController::class, 'pdf_rth'])->name('pengadaan_masuk.pdf_rth');
        Route::get('pengadaan-masuk/pdf-kontrak/{file_kontrak}', [PengadaanMasukController::class, 'pdf_kontrak'])->name('pengadaan_masuk.pdf_kontrak');

        Route::get('hibah-masuk/list-hibah/{from_date}/{to_date}/{kode_ba}', [HibahMasukController::class, 'list_hibah'])->name('hibah_masuk.list_hibah');
        Route::get('hibah-masuk/edit-hibah/{ba_hibah}', [HibahMasukController::class, 'edit_hibah'])->name('hibah_masuk.edit_hibah');
        Route::put('hibah-masuk/update-hibah/{ba_hibah}', [HibahMasukController::class, 'update_hibah'])->name('hibah_masuk.update_hibah');
        Route::get('hibah-masuk/pdf-hibah/{file_app_hibah}', [HibahMasukController::class, 'pdf_hibah'])->name('hibah_masuk.pdf_hibah');

        Route::get('report', [ReportController::class, 'index'])->name('report.index');
        Route::get('report/create', [ReportController::class, 'create'])->name('report.create');
        Route::post('report/store', [ReportController::class, 'store'])->name('report.store');
        Route::get('report/list/{id_kategori}/{from_date}/{to_date}', [ReportController::class, 'list'])->name('report.list');
        Route::get('report/pdf/{file}', [ReportController::class, 'pdf'])->name('report.pdf');
        Route::delete('report/{pelaporan}', [ReportController::class, 'destroy']);

        Route::get('aset-keluar', [TransaksiKeluarController::class, 'index_aset'])->name('aset_keluar.index');
        Route::get('persediaan-keluar', [TransaksiKeluarController::class, 'index_persediaan'])->name('persediaan_keluar.index');
        Route::get('nota-dinas/pdf/{file_nota_dinas}', [TransaksiKeluarController::class, 'pdf_nota_dinas'])->name('nota_dinas.pdf');
        Route::get('spb/pdf/{file_spb}', [TransaksiKeluarController::class, 'pdf_spb'])->name('spb.pdf');

        Route::get('pemakaian/list/{from_date}/{to_date}', [PemakaianController::class, 'list'])->name('pemakaian.list');
        Route::get('pemakaian/edit/{out_pemakaian}', [PemakaianController::class, 'edit'])->name('pemakaian.edit');
        Route::put('pemakaian/update/{out_pemakaian}', [PemakaianController::class, 'update'])->name('pemakaian.update');
        Route::get('pemakaian/pdf-ppm/{file_ppm}', [PemakaianController::class, 'pdf_ppm'])->name('pemakaian.pdf_ppm');
        Route::get('pemakaian/pdf-rth/{file_rth}', [PemakaianController::class, 'pdf_rth'])->name('pemakaian.pdf_rth');

        Route::get('transfer-keluar/list/{prefix}/{from_date}/{to_date}', [TransferKeluarController::class, 'list'])->name('transfer_keluar.list');
        Route::get('transfer-keluar/edit/{out_tktm}', [TransferKeluarController::class, 'edit'])->name('transfer_keluar.edit');
        Route::put('transfer-keluar/update/{out_tktm}', [TransferKeluarController::class, 'update'])->name('transfer_keluar.update');
        Route::get('transfer-keluar/pdf-ppm/{file_ppm}', [TransferKeluarController::class, 'pdf_ppm'])->name('transfer_keluar.pdf_ppm');
        Route::get('transfer-keluar/pdf-rth-tk/{file_rth_tk}', [TransferKeluarController::class, 'pdf_rth_tk'])->name('transfer_keluar.pdf_rth_tk');
        Route::get('transfer-keluar/pdf-rth-tm/{file_rth_tm}', [TransferKeluarController::class, 'pdf_rth_tm'])->name('transfer_keluar.pdf_rth_tm');

        Route::get('hibah-keluar/list/{prefix}/{from_date}/{to_date}', [HibahKeluarController::class, 'list'])->name('hibah_keluar.list');
        Route::get('hibah-keluar/edit/{out_hibah}', [HibahKeluarController::class, 'edit'])->name('hibah_keluar.edit');
        Route::put('hibah-keluar/update/{out_hibah}', [HibahKeluarController::class, 'update'])->name('hibah_keluar.update');
        Route::get('hibah-keluar/pdf-rth-hibah/{file_rth_hibah}', [HibahKeluarController::class, 'pdf_rth_hibah'])->name('hibah_keluar.pdf_rth_hibah');

        Route::get('daftar-barang/{in_tktm}', [DaftarBarangController::class, 'daftar_barang'])->name('daftar_barang');
        Route::post('daftar-barang/excel/import', [DaftarBarangController::class, 'excel_import'])->name('daftar_barang.excel_import');
        Route::post('daftar-barang/excel/store', [DaftarBarangController::class, 'excel_store'])->name('daftar_barang.excel_store');
        Route::get('daftar-barang/list-tujuan/{id_kontrak}/{kode_barang}/{id_rencana}', [DaftarBarangController::class, 'list_tujuan'])->name('daftar_barang.list_tujuan');
        Route::get('download-edit/{id_barang_masuk}', [DaftarBarangController::class, 'download_edit']);
        Route::post('edit-excel-brg', [DaftarBarangController::class, 'edit_excel_brg']);
        Route::post('update-excel-brg', [DaftarBarangController::class, 'update_excel_brg']);
        Route::delete('daftar-barang/{id_rencana_pengeluaran}', [DaftarBarangController::class, 'destroy']);

        // Route::prefix('struktur-organisasi')->name('struktur_organisasi.')->group(function () {
        //     Route::get('/', [StrukturOrganisasiLogistikController::class, 'index'])->name('index');
        // });
    });
});

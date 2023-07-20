<?php

use App\Http\Controllers\bidum\anggaran\HutangController;
use App\Http\Controllers\bidum\anggaran\PaguAnggaranController,
    App\Http\Controllers\bidum\anggaran\RealisasiHarianController,
    App\Http\Controllers\bidum\anggaran\DashboardController;
use App\Http\Controllers\bidum\anggaran\ReportController;
use App\Http\Controllers\bidum\anggaran\RevisiPaguController;
use Illuminate\Support\Facades\Route;

Route::prefix('bidum')->name('bidum.')->group(function () {
    Route::prefix('anggaran')->name('anggaran.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard/bidang/{year}', [DashboardController::class, 'laporan_setiap_bidang'])->name('dashboard_bidang');
        Route::get('dashboard/count-gaji/{month_year}', [DashboardController::class, 'count_gaji'])->name('dashboard_count_gaji');
        Route::get('dashboard/count-anggaran/{year}', [DashboardController::class, 'count_anggaran'])->name('dashboard_count_anggaran');
        Route::post('dashboard/pagu-realisasi-per-bidang', [DashboardController::class, 'pagu_realisasi_per_bidang']);
        Route::post('dashboard/penyerapan-anggaran', [DashboardController::class, 'penyerapan_anggaran']);

        //pagu anggaran
        Route::get('pagu', [PaguAnggaranController::class, 'index'])->name('pagu');
        Route::post('pagu', [PaguAnggaranController::class, 'store']);
        Route::get('pagu/list', [PaguAnggaranController::class, 'list_pagu'])->name('pagu_list');
        Route::post('pagu/import', [PaguAnggaranController::class, 'import'])->name('pagu_import');
        Route::post('pagu/import/store', [PaguAnggaranController::class, 'import_store'])->name('pagu_import_store');
        Route::get('pagu/export', [PaguAnggaranController::class, 'export'])->name('pagu_export');
        Route::get('pagu/{year}', [PaguAnggaranController::class, 'show_pagu'])->name('pagu_show');
        Route::get('pagu/realisasi/{year}', [PaguAnggaranController::class, 'realisasi'])->name('pagu_realisasi');
        Route::get('pagu/list-realisasi/{year}/{dipa}', [PaguAnggaranController::class, 'list_realisasi'])->name('pagu_list_realisasi');
        Route::get('pusat/{year}', [PaguAnggaranController::class, 'list_pusat'])->name('pagu_pusat');
        Route::get('daerah/{year}', [PaguAnggaranController::class, 'list_daerah'])->name('pagu_daerah');
        Route::delete('pagu/{uraian}', [PaguAnggaranController::class, 'destroy']);

        // revisi pagu
        Route::get('revisi/{id_uraian}', [RevisiPaguController::class, 'get_pagu'])->name('revisi_pagu');
        Route::get('revisi/history/{id_uraian}', [RevisiPaguController::class, 'history']);
        Route::post('revisi/store', [RevisiPaguController::class, 'store'])->name('revisi_store');

        // realisasi harian
        Route::get('realisasi-pertahun', [RealisasiHarianController::class, 'realisasi_pertahun']);
        Route::get('get-realisasi-pertahun', [RealisasiHarianController::class, 'get_realisasi_pertahun']);
        Route::get('realisasi/export-format', [RealisasiHarianController::class, 'export_format']);
        Route::get('realisasi/{tahun}', [RealisasiHarianController::class, 'index'])->name('realisasi');
        Route::get('realisasi/edit/{realisasi}', [RealisasiHarianController::class, 'edit']);
        Route::put('realisasi/{realisasi}', [RealisasiHarianController::class, 'update']);
        Route::delete('realisasi/{realisasi}', [RealisasiHarianController::class, 'destroy']);
        // Route::get('realisasi/export-format/{from_date}/{to_date}', [RealisasiHarianController::class, 'export_format'])->name('realisasi_export_format');
        Route::get('realisasi/list/{from_date}/{to_date}/{dipa}', [RealisasiHarianController::class, 'list'])->name('realisasi_list');
        Route::post('realisasi/import', [RealisasiHarianController::class, 'import'])->name('realisasi_import');
        Route::post('realisasi/import/store', [RealisasiHarianController::class, 'import_store'])->name('realisasi_import_store');
        // Route::get('realisasi/get-uraian', [RealisasiHarianController::class, 'get_uraian'])->name('get_uraian');
        Route::get('realisasi/get-uraian/{kode_dipa}/{kode_bidang}', [RealisasiHarianController::class, 'get_uraian'])->name('get_uraian');
        Route::get('realisasi/get-bidang/{kode_dipa}', [RealisasiHarianController::class, 'get_bidang'])->name('get_bidang');
        Route::post('realisasi/store', [RealisasiHarianController::class, 'store'])->name('realisasi_store');

        // report
        Route::get('report/{bidang?}', [ReportController::class, 'index'])->name('report_pagu');
        Route::get('report/export/{from_date}/{to_date}', [ReportController::class, 'export'])->name('report_export');
        Route::get('report/{from_date}/{to_date}/{dipa}/{bidang?}', [ReportController::class, 'report_list'])->name('report_list');

        Route::get('status-hutang/{id_hutang}', [HutangController::class, 'status_hutang']);

        Route::get('cicilan/get/{id_hutang}', [HutangController::class, 'get_cicilan']);
        Route::get('cicilan/{cicilan}/edit', [HutangController::class, 'edit_cicilan']);
        Route::post('cicilan', [HutangController::class, 'store_cicilan']);
        Route::put('cicilan/{cicilan}', [HutangController::class, 'update_cicilan']);
        Route::delete('cicilan/{cicilan}', [HutangController::class, 'destroy_cicilan']);

        Route::post('hutang/get', [HutangController::class, 'get']);
        Route::resource('hutang', HutangController::class);
    });
});

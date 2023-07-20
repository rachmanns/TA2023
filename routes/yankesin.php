<?php

use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ReportPenyakitController;
use App\Http\Controllers\yankesin\RumahSakitController;
use App\Http\Controllers\yankesin\DashboardController;
use App\Http\Controllers\yankesin\EndemikController;
use App\Http\Controllers\yankesin\KategoriFasilitasController;
use App\Http\Controllers\yankesin\PenyakitController;
use App\Http\Controllers\yankesin\PosyanduController;
use App\Http\Controllers\yankesin\StrukturYankesinController;
use App\Http\Controllers\yankesin\TingkatRsController;
use App\Http\Controllers\YankesinController;
use App\Http\Controllers\yankesin\covid_report\BORCovidYankesinController;
use Illuminate\Support\Facades\Route;

Route::prefix('yankesin')->name('yankesin.')->group(function () {
    Route::prefix('rumah-sakit')->name('rumah_sakit.')->group(function () {
        Route::get('/', [RumahSakitController::class, 'index'])->name('index');
        Route::post('/store', [RumahSakitController::class, 'store'])->name('store');
        Route::put('/update/{rumah_sakit}', [RumahSakitController::class, 'update'])->name('update');
        Route::get('/list', [RumahSakitController::class, 'list'])->name('list');
        Route::get('/{id_rs}', [RumahSakitController::class, 'edit'])->name('edit');
        Route::delete('/delete/{rumah_sakit}', [RumahSakitController::class, 'destroy'])->name('delete');
    });
    // RS Yankesin
    Route::get('/kelola_data_covid/{id}', [YankesinController::class, 'kelola_data_covid']);
    Route::get('/kelola_fasilitas/{id}', [YankesinController::class, 'kelola_fasilitas']);
    Route::get('/kelola_nakes/{id}', [YankesinController::class, 'kelola_nakes']);
    Route::get('/kelola_bor/{id}', [YankesinController::class, 'kelola_bor']);
    Route::get('/ubah_kelola_bor/{id}', [YankesinController::class, 'ubah_kelola_bor']);
    Route::prefix('input')->group(function () {
        Route::get('/bor', [YankesinController::class, 'input_bor']);
        Route::get('/bor-list', [YankesinController::class, 'get_list_bor']);
        Route::post('/bor-store', [YankesinController::class, 'input_bor_store']);
        Route::get('/bor-edit/{id}', [YankesinController::class, 'input_bor_edit']);
        Route::post('/bor-update/{id}', [YankesinController::class, 'input_bor_update']);
        Route::delete('/bor-delete/{id}', [YankesinController::class, 'input_bor_destroy']);

        Route::get('/covid', [YankesinController::class, 'input_covid']);
        Route::get('/covid-list', [YankesinController::class, 'get_list_covid']);
        Route::post('/covid-store', [YankesinController::class, 'input_covid_store']);
        Route::get('/covid-edit/{id}', [YankesinController::class, 'input_covid_edit']);
        Route::post('/covid-update/{id}', [YankesinController::class, 'input_covid_update']);
        Route::delete('/covid-delete/{id}', [YankesinController::class, 'input_covid_destroy']);

        Route::post('/fasilitas', [YankesinController::class, 'input_fasilitas']);
        Route::post('/fasilitas-rs', [YankesinController::class, 'input_fasilitas_rs']);
        Route::post('/nakes', [YankesinController::class, 'input_nakes']);
    });

    Route::get('/', [YankesinController::class, 'index']);
    Route::get('/data-bor', [YankesinController::class, 'monitoring_bor']);
    Route::get('/data-covid', [YankesinController::class, 'monitoring_pasien_covid']);
    Route::get('/data-nakes/{kategori}/{id}', [YankesinController::class, 'monitoring_nakes']);
    Route::get('/peta-sebaran-fasilitas', [DashboardController::class, 'peta_sebaran_fasilitas']);
    Route::get('/peta-sebaran-posyandu', [DashboardController::class, 'peta_sebaran_posyandu']);
    Route::get('/rekap-fasilitas-faskes', [DashboardController::class, 'rekap_fasilitas_faskes']);
    Route::get('/rekap-fasilitas-faskes/list', [DashboardController::class, 'rekap_fasilitas_faskes_list']);
    Route::get('/rekap-fasilitas-faskes/detail/{kat}/{id}', [DashboardController::class, 'rekap_fasilitas_faskes_detail']);
    Route::get('/dokter-faskes-detail/{id}', [DashboardController::class, 'dokter_faskes_detail']);

    Route::get('/struktur-organisasi', [StrukturYankesinController::class, 'index']);

    Route::get('kategori-fasilitas/get', [KategoriFasilitasController::class, 'get']);
    Route::resource('kategori-fasilitas', KategoriFasilitasController::class)->except(['create'])->parameters([
        'kategori-fasilitas' => 'kategori_fasilitas'
    ]);

    Route::get('fasilitas/get', [FasilitasController::class, 'get']);
    Route::resource('fasilitas', FasilitasController::class)->except(['create'])->parameters([
        'fasilitas' => 'fasilitas'
    ]);

    Route::prefix('report-penyakit')->group(function () {
        Route::get('/', [ReportPenyakitController::class, 'index']);
        Route::get('/create', [ReportPenyakitController::class, 'edit']);
        Route::post('/store', [ReportPenyakitController::class, 'store']);
        Route::get('/edit/{id}', [ReportPenyakitController::class, 'edit']);
        Route::post('/update/{id}', [ReportPenyakitController::class, 'update']);
        Route::delete('/delete/{id}', [ReportPenyakitController::class, 'destroy']);
        Route::get('/list', [ReportPenyakitController::class, 'get_list']);
        Route::get('/detail/{id_penyakit}/{satker}', [ReportPenyakitController::class, 'get_detail']);
    });

    Route::get('tingkat-rs/get', [TingkatRsController::class, 'get']);
    Route::resource('tingkat-rs', TingkatRsController::class)->except(['create'])->parameters([
        'tingkat-rs' => 'tingkat_rs'
    ]);

    Route::get('endemik/get', [EndemikController::class, 'get']);
    Route::resource('endemik', EndemikController::class)->except(['create']);

    Route::get('penyakit/get', [PenyakitController::class, 'get']);
    Route::resource('penyakit', PenyakitController::class)->except(['create']);

    Route::get('penyakit/get', [PenyakitController::class, 'get']);
    Route::resource('penyakit', PenyakitController::class)->except(['create']);

    Route::get('posyandu/get', [PosyanduController::class, 'get']);
    Route::get('posyandu/download-template', [PosyanduController::class, 'download_template']);
    Route::post('posyandu/upload', [PosyanduController::class, 'upload']);
    Route::post('posyandu/import', [PosyanduController::class, 'import']);
    Route::resource('posyandu', PosyanduController::class);

    Route::get('/dashboard_nakes/detail/{kat}/{klasifikasi}/{nakes}', [DashboardController::class,  'dashboard_nakes_detail']);
    Route::prefix('bor-covid')->name('bor_covid.')->group(function () {
        Route::get('/detail', [BORCovidYankesinController::class, 'dashboard_bor_detail']);
        Route::get('/{id?}', [BORCovidYankesinController::class, 'index'])->name('index');
    });
});

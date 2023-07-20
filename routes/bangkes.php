<?php

use App\Http\Controllers\bangkes\JenisParamedisController;
use App\Http\Controllers\bangkes\JenisPelatihanController;
use App\Http\Controllers\bangkes\JenisSpesialisController;
use App\Http\Controllers\bangkes\KategoriBukuController;
use App\Http\Controllers\bangkes\sdm\ApprovalNakesController;
use App\Http\Controllers\bangkes\sdm\CalonPatubelController;
use App\Http\Controllers\bangkes\sdm\DashboardSdmController;
use App\Http\Controllers\bangkes\sdm\DocTenagaMedisController;
use App\Http\Controllers\bangkes\sdm\ParamedisController;
use App\Http\Controllers\bangkes\sdm\PelatihanBangkesController;
use App\Http\Controllers\bangkes\sdm\PesertaBangkesController;
use App\Http\Controllers\bangkes\sdm\PesertaPatubelController;
use App\Http\Controllers\bangkes\sdm\SelesaiInternshipController;
use App\Http\Controllers\bangkes\sdm\TenagaMedisController;
use App\Http\Controllers\bangkes\sdm\WahanaInternshipController;
use App\Http\Controllers\bangkes\sistoda\BukuController;
use App\Http\Controllers\bangkes\sistoda\DashboardSistodaController;
use App\Http\Controllers\bangkes\sistoda\EventBukuController;
use App\Http\Controllers\bangkes\sistoda\KatalogBukuController;
use App\Http\Controllers\bangkes\sistoda\KatalogController;
use App\Http\Controllers\bangkes\sistoda\SupervisiController;
use Illuminate\Support\Facades\Route;

Route::prefix('bangkes')->name('bangkes.')->group(function () {
    Route::prefix('sistoda')->name('sistoda.')->group(function () {
        Route::get('dashboard', [DashboardSistodaController::class, 'index']);
        Route::get('detail-jadwal/{id}/{prefix}', [DashboardSistodaController::class, 'detail_jadwal']);
        Route::get('detail-jumlah/{kat_buku}', [DashboardSistodaController::class, 'detail_jumlah']);
    });

    Route::prefix('sdm')->name('sdm.')->group(function () {
        Route::get('dashboard', [DashboardSdmController::class, 'index']);
        Route::post('dashboard/count-patubel', [DashboardSdmController::class, 'count_patubel']);
    });

    Route::get('buku/list', [BukuController::class, 'list'])->name('buku.list');
    Route::resource('buku', BukuController::class);

    Route::post('kotakab/list', [EventBukuController::class, 'kota_kab_list']);
    Route::get('jadwal-sosialisasi/list', [EventBukuController::class, 'list']);
    Route::resource('jadwal-sosialisasi', EventBukuController::class)->parameters([
        'jadwal-sosialisasi' => 'event_buku'
    ]);

    Route::get('jadwal-supervisi/list', [SupervisiController::class, 'list']);
    Route::resource('jadwal-supervisi', SupervisiController::class)->parameters([
        'jadwal-supervisi' => 'supervisi'
    ]);

    Route::get('jenis-spesialis/list', [JenisSpesialisController::class, 'list'])->name('jenis-spesialis.list');
    Route::resource('jenis-spesialis', JenisSpesialisController::class)->except([
        'create', 'edit'
    ])->parameters([
        'jenis-spesialis' => 'jenis_spesialis'
    ]);

    Route::post('tenaga-medis/list', [TenagaMedisController::class, 'list']);
    Route::resource('tenaga-medis', TenagaMedisController::class)->parameters([
        'tenaga-medis' => 'dokter'
    ]);
    Route::post('get-spesialis', [TenagaMedisController::class, 'jenis_spesialis_list']);

    Route::post('paramedis/list', [ParamedisController::class, 'list']);
    Route::resource('paramedis', ParamedisController::class)->parameters([
        'paramedis' => 'paramedis'
    ]);

    Route::get('jenis-paramedis/list', [JenisParamedisController::class, 'list']);
    Route::resource('jenis-paramedis', JenisParamedisController::class)->except(['create', 'edit'])->parameters(['jenis-paramedis' => 'jenis_paramedis']);

    Route::post('wahana-internship/list', [WahanaInternshipController::class, 'list']);
    Route::resource('wahana-internship', WahanaInternshipController::class)->parameters([
        'wahana-internship' => 'internship'
    ]);;

    Route::post('selesai-internship/list', [SelesaiInternshipController::class, 'list']);
    Route::resource('selesai-internship', SelesaiInternshipController::class);

    Route::post('katalog-buku/list', [KatalogBukuController::class, 'list']);
    Route::resource('katalog-buku', KatalogBukuController::class)->parameters([
        'katalog-buku' => 'buku'
    ]);

    Route::get('jenis-pelatihan/get', [JenisPelatihanController::class, 'get']);
    Route::resource('jenis-pelatihan', JenisPelatihanController::class)->except([
        'create', 'edit'
    ]);

    Route::post('pelatihan/get', [PelatihanBangkesController::class, 'get']);
    Route::resource('pelatihan', PelatihanBangkesController::class)->parameters([
        'pelatihan' => 'pelatihan_bangkes'
    ]);

    Route::post('peserta/get', [PesertaBangkesController::class, 'get']);
    Route::get('peserta/create/{id_pelatihan_bangkes}', [PesertaBangkesController::class, 'create']);
    Route::get('peserta/edit/{id_pelatihan_bangkes}/{peserta_bangkes}', [PesertaBangkesController::class, 'edit']);
    Route::post('peserta', [PesertaBangkesController::class, 'store']);
    Route::put('peserta/{peserta_bangkes}', [PesertaBangkesController::class, 'update']);
    Route::delete('peserta/{peserta_bangkes}', [PesertaBangkesController::class, 'destroy']);

    Route::post('calon-patubel/get', [CalonPatubelController::class, 'get']);
    Route::post('calon-patubel/get-nakes', [CalonPatubelController::class, 'get_nakes']);
    Route::get('calon-patubel/get-patubel-nakes/{id_nakes}', [CalonPatubelController::class, 'get_patubel_nakes']);
    Route::get('calon-patubel/detail/{id_nakes}/{ket_peserta}', [CalonPatubelController::class, 'detail']);
    Route::resource('calon-patubel', CalonPatubelController::class)->parameters([
        'calon-patubel' => 'patubel'
    ]);

    Route::post('peserta-patubel/get', [PesertaPatubelController::class, 'get']);
    Route::resource('peserta-patubel', PesertaPatubelController::class)->except(['create', 'store'])->parameters([
        'peserta-patubel' => 'patubel'
    ]);

    Route::prefix('approval-nakes')->group(function () {
        Route::get('/', [ApprovalNakesController::class, 'index']);
        Route::get('/get_dokter', [ApprovalNakesController::class, 'get_dokter']);
        Route::get('/get_paramedis', [ApprovalNakesController::class, 'get_paramedis']);
        Route::put('/approve-dokter', [ApprovalNakesController::class, 'approve_dokter']);
        Route::put('/approve-paramedis', [ApprovalNakesController::class, 'approve_paramedis']);
    });

    Route::get('kategori-buku/get', [KategoriBukuController::class, 'get']);
    Route::resource('kategori-buku', KategoriBukuController::class);

    Route::prefix('rekap-dokter')->group(function () {
        Route::get('/', [TenagaMedisController::class, 'rekap_dokter']);
        Route::post('get', [TenagaMedisController::class, 'rekap_dokter_get']);
    });

    Route::get('dokumen-tenaga-medis/get', [DocTenagaMedisController::class, 'get']);
    Route::resource('dokumen-tenaga-medis', DocTenagaMedisController::class)->except(['create'])->parameters([
        'dokumen-tenaga-medis' => 'doc_tenaga_medis'
    ]);
});

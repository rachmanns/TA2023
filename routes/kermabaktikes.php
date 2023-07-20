<?php

use App\Http\Controllers\kermabaktikes\bakti\BakesController;
use App\Http\Controllers\kermabaktikes\kerma\BilateralController;
use App\Http\Controllers\kermabaktikes\kerma\KdnController;
use App\Http\Controllers\kermabaktikes\kerma\MapsKermaController;
use App\Http\Controllers\kermabaktikes\kerma\MouController;
use App\Http\Controllers\kermabaktikes\kerma\NonBilateralController;
use App\Http\Controllers\kermabaktikes\master\EventController;
use App\Http\Controllers\kermabaktikes\master\JenisKegiatanController;
use App\Http\Controllers\kermabaktikes\master\KegiatanController;
use App\Http\Controllers\kermabaktikes\master\KeteranganController;
use App\Http\Controllers\kermabaktikes\master\StatusController;
use Illuminate\Support\Facades\Route;

Route::prefix('kerma')->name('kerma.')->group(function () {
    Route::post('mou/list', [MouController::class, 'list'])->name('mou.list');
    Route::get('mou/file_doc/{file_doc}', [MouController::class, 'file_doc']);
    Route::resource('mou', MouController::class)->except(['show']);

    Route::get('event/list', [EventController::class, 'list'])->name('event.list');
    Route::resource('event', EventController::class)->except([
        'create', 'edit'
    ]);

    Route::get('kegiatan/list', [KegiatanController::class, 'list'])->name('kegiatan.list');
    Route::resource('kegiatan', KegiatanController::class)->except([
        'create', 'edit'
    ]);

    Route::get('jenis-kegiatan/list', [JenisKegiatanController::class, 'list'])->name('jenis_kegiatan.list');
    Route::resource('jenis-kegiatan', JenisKegiatanController::class)->except([
        'create', 'edit'
    ])->names([
        'index' => 'jenis_kegiatan.index',
        'store' => 'jenis_kegiatan.store',
        'show' => 'jenis_kegiatan.show',
        'update' => 'jenis_kegiatan.update',
        'destroy' => 'jenis_kegiatan.destroy'
    ]);

    Route::get('status/list', [StatusController::class, 'list'])->name('status.list');
    Route::resource('status', StatusController::class)->except([
        'create', 'edit'
    ]);

    Route::get('keterangan/list', [KeteranganController::class, 'list'])->name('keterangan.list');
    Route::resource('keterangan', KeteranganController::class)->except([
        'create', 'edit'
    ]);

    Route::get('bilateral/dashboard', [BilateralController::class, 'dashboard'])->name('bilateral.dashboard');
    Route::post('bilateral/jadwal-bilateral', [BilateralController::class, 'jadwal_bilateral']);
    // Route::get('bilateral/detail-dashboard/{data}', [BilateralController::class, 'detail_dashboard'])->name('bilateral.detail_dashboard');
    Route::get('bilateral/detail-dashboard/', [BilateralController::class, 'detail_dashboard'])->name('bilateral.detail_dashboard');
    // Route::get('bilateral/detail-dashboard/{nama_event}/{nama_kegiatan}', [BilateralController::class, 'detail_dashboard'])->name('bilateral.detail_dashboard');
    Route::post('bilateral/list', [BilateralController::class, 'list'])->name('bilateral.list');
    Route::get('bilateral/get-kegiatan/{id_event}', [BilateralController::class, 'get_kegiatan']);
    Route::get('bilateral/file_laporan/{file_laporan}', [BilateralController::class, 'file_laporan']);
    Route::resource('bilateral', BilateralController::class)->except(['show']);

    Route::get('nonbilateral/dashboard', [NonBilateralController::class, 'dashboard'])->name('nonbilateral.dashboard');
    Route::post('nonbilateral/jadwal-bilateral', [NonBilateralController::class, 'jadwal_nonbilateral']);
    Route::get('nonbilateral/detail-dashboard/{tahun}/{nama_kegiatan}', [NonBilateralController::class, 'detail_dashboard']);
    Route::get('nonbilateral/file_laporan/{file_laporan}', [NonBilateralController::class, 'file_laporan']);
    Route::post('nonbilateral/list', [NonBilateralController::class, 'list'])->name('nonbilateral.list');
    Route::resource('nonbilateral', NonBilateralController::class)->except(['show']);

    Route::get('kdn/dashboard', [KdnController::class, 'dashboard'])->name('kdn.dashboard');
    Route::get('kdn/file_laporan/{file_laporan}', [KdnController::class, 'file_laporan']);
    Route::post('kdn/list', [KdnController::class, 'list'])->name('kdn.list');
    Route::resource('kdn', KdnController::class)->except(['show']);
});

Route::prefix('bakti')->name('bakti.')->group(function () {
    Route::get('bakes/dashboard', [BakesController::class, 'dashboard'])->name('bakes.dashboard');
    Route::post('bakes/list', [BakesController::class, 'list'])->name('bakes.list');
    Route::get('bakes/file_laporan/{file_laporan}', [BakesController::class, 'file_laporan']);
    Route::resource('bakes', BakesController::class)->except(['show']);
});

Route::prefix('maps-kerma')->group(function () {
    Route::get('/', [MapsKermaController::class, 'index']);
    // Route::post('bakes/list', [BakesController::class, 'list'])->name('bakes.list');
    // Route::get('bakes/file_laporan/{file_laporan}', [BakesController::class, 'file_laporan']);
    // Route::resource('bakes', BakesController::class)->except(['show']);
});

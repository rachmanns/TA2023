<?php

use App\Http\Controllers\dukkesops\AnggaranDukController;
use App\Http\Controllers\dukkesops\BatalyonController;
use App\Http\Controllers\dukkesops\bekkes\SatgasDNController;
use App\Http\Controllers\dukkesops\bekkes\SatgasLNController;
use App\Http\Controllers\dukkesops\BekkesPenugasanController;
use App\Http\Controllers\dukkesops\CalendarDukkesController;
use App\Http\Controllers\dukkesops\DukkesController;
use App\Http\Controllers\dukkesops\master\GeografisController;
use App\Http\Controllers\dukkesops\master\KategoriDukController;
use App\Http\Controllers\dukkesops\master\TipePosController;
use App\Http\Controllers\dukkesops\master\MasterBekkesController;
use App\Http\Controllers\dukkesops\PenugasanPosController;
use App\Http\Controllers\dukkesops\PenugasanSatgasController;
use App\Http\Controllers\dukkesops\PosSatgasController;
use App\Http\Controllers\dukkesops\rikujikkes\PendidikanController;
use App\Http\Controllers\dukkesops\rikujikkes\SeleksiSatgasController;
use App\Http\Controllers\dukkesops\rikujikkes\SeleksiSatgasLNController;
use App\Http\Controllers\dukkesops\rikujikkes\WervingController;
use App\Http\Controllers\dukkesops\RSPemdaSwastaController;
use App\Http\Controllers\dukkesops\SatgasOpsController;
use Illuminate\Support\Facades\Route;

Route::prefix('dukkesops')->name('dukkesops.')->group(function () {

  //start
  Route::group(['middleware' => ['secret.page']], function () {

    Route::post('werving/preview', [WervingController::class, 'preview'])->name('werving.preview');
    Route::post('werving/preview-update-data/{id_kegiatan_duk}', [WervingController::class, 'preview_update_data'])->name('werving.preview_update_data');
    Route::post('werving/update-data', [WervingController::class, 'update_data'])->name('werving.update_data');
    Route::delete('werving/delete-data/{id_data_kegiatan_duk}', [WervingController::class, 'destroy_data_kegiatan']);
    Route::post('werving/list', [WervingController::class, 'list'])->name('werving.list');
    Route::get('werving/list-data-kegiatan/{id_kegiatan_duk}', [WervingController::class, 'list_data_kegiatan'])->name('werving.list_data_kegiatan');
    Route::get('werving/{id_kegiatan_duk}/edit_werving', [WervingController::class, 'edit_werving']);
    Route::post('werving/update_werving', [WervingController::class, 'update_werving'])->name('werving.update_werving');
    Route::resource('werving', WervingController::class);

    Route::post('seleksi-satgas/preview', [SeleksiSatgasController::class, 'preview']);
    Route::post('seleksi-satgas/list', [SeleksiSatgasController::class, 'list']);
    Route::get('seleksi-satgas/list-data-kegiatan/{id_kegiatan_duk}', [SeleksiSatgasController::class, 'list_data_kegiatan']);
    Route::delete('seleksi-satgas/delete-data/{id_data_kegiatan_duk}', [SeleksiSatgasController::class, 'destroy_data_kegiatan']);
    Route::post('seleksi-satgas/preview-update-data/{id_kegiatan_duk}', [SeleksiSatgasController::class, 'preview_update_data']);
    Route::post('seleksi-satgas/update-data', [SeleksiSatgasLNController::class, 'update_data']);
    Route::get('seleksi-satgas/{seleksi_satgas_ln}', [SeleksiSatgasController::class, 'show']);
    Route::get('seleksi-satgas-edit/{seleksi_satgas_ln}', [SeleksiSatgasController::class, 'edit']);
    Route::put('seleksi-satgas/{id_data_kegiatan_duk}', [SeleksiSatgasController::class, 'update']);
    Route::get('seleksi-satgas/create/{jenis_kegiatan}/{keterangan}', [SeleksiSatgasController::class, 'create']);
    Route::post('seleksi-satgas', [SeleksiSatgasController::class, 'store']);
    Route::delete('seleksi-satgas/{seleksi_satgas_ln}', [SeleksiSatgasController::class, 'destroy']);
    Route::get('seleksi-satgas/{jenis_kegiatan}/{keterangan}', [SeleksiSatgasController::class, 'index']);


    // Route::post('seleksi-satgas-ln/preview', [SeleksiSatgasLNController::class, 'preview']);
    // Route::post('seleksi-satgas-ln/list', [SeleksiSatgasLNController::class, 'list']);
    // Route::get('seleksi-satgas-ln/list-data-kegiatan/{id_kegiatan_duk}', [SeleksiSatgasLNController::class, 'list_data_kegiatan']);
    // Route::delete('seleksi-satgas-ln/delete-data/{id_data_kegiatan_duk}', [SeleksiSatgasLNController::class, 'destroy_data_kegiatan']);
    // Route::post('seleksi-satgas-ln/preview-update-data/{id_kegiatan_duk}', [SeleksiSatgasLNController::class, 'preview_update_data']);
    // Route::post('seleksi-satgas-ln/update-data', [SeleksiSatgasLNController::class, 'update_data']);
    // // Route::resource('seleksi-satgas-ln', SeleksiSatgasLNController::class);
    // Route::get('seleksi-satgas-ln/{keterangan}', [SeleksiSatgasLNController::class, 'index']);
    // Route::get('seleksi-satgas-ln/{seleksi_satgas_ln}/show', [SeleksiSatgasLNController::class, 'show']);
    // Route::get('seleksi-satgas-ln/{seleksi_satgas_ln}/edit', [SeleksiSatgasLNController::class, 'edit']);
    // Route::put('seleksi-satgas-ln/{id_data_kegiatan_duk}', [SeleksiSatgasLNController::class, 'update']);
    // Route::get('seleksi-satgas-ln/create/{keterangan}', [SeleksiSatgasLNController::class, 'create']);
    // Route::post('seleksi-satgas-ln', [SeleksiSatgasLNController::class, 'store']);
    // Route::delete('seleksi-satgas-ln/{seleksi_satgas_ln}', [SeleksiSatgasLNController::class, 'destroy']);


    Route::post('pendidikan/preview', [PendidikanController::class, 'preview']);
    Route::post('pendidikan/update-data', [PendidikanController::class, 'update_data']);
    Route::post('pendidikan/list', [PendidikanController::class, 'list']);
    Route::get('pendidikan/list-data-kegiatan/{id_kegiatan_duk}', [PendidikanController::class, 'list_data_kegiatan']);
    Route::delete('pendidikan/delete-data/{id_data_kegiatan_duk}', [PendidikanController::class, 'destroy_data_kegiatan']);
    Route::post('pendidikan/preview-update-data/{id_kegiatan_duk}', [PendidikanController::class, 'preview_update_data']);
    Route::resource('pendidikan', PendidikanController::class);
  });
  //end


  Route::post('anggaran/list', [AnggaranDukController::class, 'list']);
  Route::resource('anggaran', AnggaranDukController::class);

  Route::post('satgas-ln/list', [SatgasLNController::class, 'list']);
  Route::resource('satgas-ln', SatgasLNController::class)->except(['create']);

  Route::post('satgas-dn/list', [SatgasDNController::class, 'list']);
  Route::resource('satgas-dn', SatgasDNController::class)->except(['create']);

  Route::get('dukkes/list', [DukkesController::class, 'list']);
  Route::resource('dukkes', DukkesController::class)->parameters([
    'dukkes' => 'dukkes'
  ])->except(['create']);

  Route::get('kategori-duk/get', [KategoriDukController::class, 'get']);
  Route::resource('kategori-duk', KategoriDukController::class);

  Route::get('tipe-pos/get', [TipePosController::class, 'list']);
  Route::get('tipe-pos/edit/{id}', [TipePosController::class, 'edit']);
  Route::resource('tipe-pos', TipePosController::class);

  Route::get('pos-satgas/peta-sebaran', [PosSatgasController::class, 'peta_sebaran']);
  Route::get('pos-satgas/get', [PosSatgasController::class, 'get']);
  Route::get('pos-satgas/get-bekkes/{id_mas_bek}', [PosSatgasController::class, 'get_bekkes']);
  Route::get('pos-satgas/faskes-rujukan/{pos_satgas}', [PosSatgasController::class, 'form_faskes_rujukan']);
  Route::post('pos-satgas/faskes-rujukan/{pos_satgas}', [PosSatgasController::class, 'update_faskes_rujukan']);
  Route::resource('pos-satgas', PosSatgasController::class)->parameters([
    'pos-satgas' => 'pos_satgas'
  ]);

  Route::get('satgas-ops/get', [SatgasOpsController::class, 'get']);
  Route::resource('satgas-ops', SatgasOpsController::class)->parameters([
    'satgas-ops' => 'satgas_ops'
  ]);

  Route::get('batalyon/get', [BatalyonController::class, 'get']);
  Route::resource('batalyon', BatalyonController::class);

  Route::get('geografis/get', [GeografisController::class, 'get']);
  Route::resource('geografis', GeografisController::class)->parameters([
    'geografis' => 'geografis'
  ]);

  Route::get('master-bekkes/get', [MasterBekkesController::class, 'get']);
  Route::post('master-bekkes/update-urutan', [MasterBekkesController::class, 'update_urutan']);
  Route::resource('master-bekkes', MasterBekkesController::class)->parameters([
    'master-bekkes' => 'master_bekkes'
  ]);

  Route::post('get-faskes', [PosSatgasController::class, 'get_faskes']);

  Route::get('rs/get', [RSPemdaSwastaController::class, 'get']);
  Route::resource('rs', RSPemdaSwastaController::class)->parameters([
    'rs' => 'rs_pemda_swasta'
  ]);

  // rotasi satgas
  Route::get('rotasi-satgas/create/{jenis_satgas}', [PenugasanSatgasController::class, 'create']);
  Route::post('rotasi-satgas', [PenugasanSatgasController::class, 'store']);
  Route::post('rotasi-satgas/get', [PenugasanSatgasController::class, 'get']);
  Route::get('rotasi-satgas/get-kat/{id_tugas}', [PenugasanSatgasController::class, 'get_kat']);
  Route::post('rotasi-satgas/field-batalyon/', [PenugasanSatgasController::class, 'field_batalyon']);
  Route::delete('rotasi-satgas/{penugasan_satgas}', [PenugasanSatgasController::class, 'destroy']);
  Route::get('rotasi-satgas/edit/{jenis_satgas}/{penugasan_satgas}', [PenugasanSatgasController::class, 'edit']);
  Route::put('rotasi-satgas/{penugasan_satgas}', [PenugasanSatgasController::class, 'update']);
  Route::get('rotasi-satgas/download-template/{jenis_satgas}/{tahun}', [PenugasanSatgasController::class, 'download']);
  Route::get('rotasi-satgas/show/{penugasan_satgas}', [PenugasanSatgasController::class, 'show']);
  Route::post('rotasi-satgas/upload/{jenis_satgas}', [PenugasanSatgasController::class, 'upload']);
  Route::post('rotasi-satgas/import', [PenugasanSatgasController::class, 'import']);
  Route::get('rotasi-satgas/{jenis_satgas}', [PenugasanSatgasController::class, 'index']);

  Route::get('/kalender/{type}/{year?}', [CalendarDukkesController::class, 'index']);

  Route::get('penugasan-pos/download-template/{penugasan_satgas}', [PenugasanPosController::class, 'download']);
  Route::post('penugasan-pos/upload/{penugasan_satgas}', [PenugasanPosController::class, 'upload']);
  Route::post('penugasan-pos/import', [PenugasanPosController::class, 'import']);

  Route::get('penugasan-pos/detail-personil/{penugasan_pos}', [PenugasanPosController::class, 'detail_personil']);
  Route::get('penugasan-pos/create-anggota/{penugasan_pos}', [PenugasanPosController::class, 'create_anggota']);
  Route::post('penugasan-pos/store-anggota/', [PenugasanPosController::class, 'store_anggota']);
  Route::resource('penugasan-pos', PenugasanPosController::class)->parameters([
    'penugasan-pos' => 'penugasan_pos'
  ]);

  Route::get('detail-anggota/get/{id_penugasan_pos}', [PenugasanPosController::class, 'get_personil']);
  Route::delete('detail-anggota/{detail_anggota}', [PenugasanPosController::class, 'destroy_personil']);

  // Route::controller(BekkesPenugasanController::class)->group(function () {
  //   Route::get('/bekkes-satgas/{jenis_satgas}', 'index');
  //   Route::get('/bekkes-satgas/{jenis_satgas}/create', 'create');
  //   Route::post('/bekkes-satgas', 'store');
  //   Route::get('/bekkes-satgas/{jenis_satgas}/get', 'get');
  //   Route::get('/bekkes-satgas/{bekkes_penugasan}/edit', 'edit');
  //   Route::put('/bekkes-satgas/{bekkes_penugasan}', 'update');
  //   Route::delete('/bekkes-satgas/{bekkes_penugasan}', 'destroy');
  // });

  Route::prefix('bekkes-satgas')->group(function () {
    Route::get('/{jenis_satgas}', [BekkesPenugasanController::class, 'index']);
    Route::get('/{jenis_satgas}/create', [BekkesPenugasanController::class, 'create']);
    Route::post('/preview', [BekkesPenugasanController::class, 'preview']);
    Route::post('/import', [BekkesPenugasanController::class, 'import']);
    Route::post('/', [BekkesPenugasanController::class, 'store']);
    Route::post('/{jenis_satgas}/get', [BekkesPenugasanController::class, 'get']);
    Route::get('/{bekkes_penugasan}/edit', [BekkesPenugasanController::class, 'edit']);
    Route::put('/{bekkes_penugasan}', [BekkesPenugasanController::class, 'update']);
    Route::delete('/{bekkes_penugasan}', [BekkesPenugasanController::class, 'destroy']);
  });
});

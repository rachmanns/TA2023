<?php

use App\Http\Controllers\faskes\FaskesNakesController;
use App\Http\Controllers\faskes\FaskesParamedisController;
use App\Http\Controllers\RumahSakitController;
use Illuminate\Support\Facades\Route;

Route::prefix('faskes')->name('faskes.')->group(function () {
    Route::get('/perubahan_faskes', function () {
        return view('yankesin.pengajuan_rs.index', ['active_menu' => 'pengajuan_rs']);
    });
    Route::get('/perubahan_faskes/list', [RumahSakitController::class, 'get_list']);
    //RKO
    Route::get('/rko', function () {
        return view('rumah_sakit.rko.index', ['active_menu' => 'rko']);
    });
    
    // Route Nakes
    // Route::post('tenaga-medis/list', [FaskesNakesController::class, 'list']);
    Route::get('tenaga-medis/list/filter/{matra?}/{id_spesialis?}', [FaskesNakesController::class, 'list_filter']);
    Route::resource('tenaga-medis', FaskesNakesController::class)->parameters([
        'tenaga-medis' => 'dokter'
    ]);
    Route::post('get-spesialis', [FaskesNakesController::class, 'jenis_spesialis_list']);

    // Route Paramedis
    Route::get('paramedis/list/filter/{matra?}/{id_jenis_paramedis?}', [FaskesParamedisController::class, 'list_filter']);
    Route::resource('paramedis', FaskesParamedisController::class)->parameters([
        'paramedis' => 'paramedis'
    ]);

    // Rekap Nakes
    Route::get('/rekap_nakes', 'App\Http\Controllers\YankesinController@kelola_nakes');
    // Bor
    Route::get('/bor', 'App\Http\Controllers\YankesinController@kelola_bor');
    Route::get('/bor_edit', 'App\Http\Controllers\YankesinController@ubah_kelola_bor');
    // Bor Covid
    Route::get('/data_covid', 'App\Http\Controllers\YankesinController@kelola_data_covid');
    // Fasilitas RS
    Route::get('/fasilitas', 'App\Http\Controllers\YankesinController@kelola_fasilitas');
});

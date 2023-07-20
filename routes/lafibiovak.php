<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\lafibiovak\ProdukController;
use App\Http\Controllers\lafibiovak\SatuanProdukController;
use App\Http\Controllers\lafibiovak\KemasanController;
use App\Http\Controllers\lafibiovak\KategoriBahanProduksiController;
use App\Http\Controllers\lafibiovak\BahanProduksiController;
use App\Http\Controllers\lafibiovak\TransaksiBahanProduksiController;
use App\Http\Controllers\lafibiovak\JalurCompanyController;
use App\Http\Controllers\lafibiovak\LitbangController;

Route::prefix('lafibiovak')->name('lafibiovak.')->group(function () {
    Route::get('produk/list', [ProdukController::class, 'list']);
    Route::resource('produk', ProdukController::class);
    Route::get('satuan-produk/list', [SatuanProdukController::class, 'list']);
    Route::resource('satuan-produk', SatuanProdukController::class);
    Route::get('kemasan/list', [KemasanController::class, 'list']);
    Route::post('kemasan/{id}', [KemasanController::class, 'update']);
    Route::resource('kemasan', KemasanController::class);
    Route::get('kategori-bahan-produksi/list', [KategoriBahanProduksiController::class, 'list']);
    Route::resource('kategori-bahan-produksi', KategoriBahanProduksiController::class);
    Route::get('bahan-produksi/list', [BahanProduksiController::class, 'list']);
    Route::resource('bahan-produksi', BahanProduksiController::class);
    Route::get('transaksi-bahan-produksi/{id}/list', [TransaksiBahanProduksiController::class, 'list']);
    Route::resource('transaksi-bahan-produksi/{idb}/data', TransaksiBahanProduksiController::class);
    Route::get('maps_jalur_company', 'App\Http\Controllers\lafibiovak\DashboardController@petaLokasiJalurCompany');
    Route::get('jalur-company/list', [JalurCompanyController::class, 'list']);
    Route::post('jalur-company/{id}', [JalurCompanyController::class, 'update']);
    Route::resource('jalur-company', JalurCompanyController::class)->except(['update']);
    Route::get('litbang/list', [LitbangController::class, 'list']);
    Route::post('litbang/{id}', [LitbangController::class, 'update']);
    Route::resource('litbang', LitbangController::class)->except(['update']);
    // RKO Faskes
    Route::prefix('rko')->group(function () {
        Route::get('/', 'App\Http\Controllers\lafibiovak\RKOController@index');
        Route::get('/list', 'App\Http\Controllers\lafibiovak\RKOController@list');
        Route::get('/total', 'App\Http\Controllers\lafibiovak\RKOController@total');
        Route::get('/form/{id?}', 'App\Http\Controllers\lafibiovak\RKOController@form');
        Route::get('/download_template', 'App\Http\Controllers\lafibiovak\RKOController@download');
        Route::get('/faskes', function () {
            return view('rumah_sakit.rko.index', ['active_menu' => 'rko']);
        });
        Route::get('/list-faskes', 'App\Http\Controllers\lafibiovak\RKOController@list_faskes');
        Route::get('download/{file}', 'App\Http\Controllers\lafibiovak\RKOController@rkoFile');
        Route::post('/upload', 'App\Http\Controllers\lafibiovak\RKOController@upload');
        Route::post('/approve/{id}', 'App\Http\Controllers\lafibiovak\RKOController@approve');
        Route::post('/reject/{id}', 'App\Http\Controllers\lafibiovak\RKOController@reject');
        Route::delete('/{id}', 'App\Http\Controllers\lafibiovak\RKOController@destroy');
        // Rekap RKO
        Route::get('/rekap', function () {
            return view('lafibiovak.manage_rko.rekap_rko.index', ['active_menu' => 'rekap_rko']);
        });
        Route::get('/list-rekap', 'App\Http\Controllers\lafibiovak\RKOController@list_rekap');
    });
    // Manage Renprod
    Route::prefix('renprod')->group(function () {
        Route::get('/', function () {
            return view('lafibiovak.manage_renprod.index', ['active_menu' => 'manage_renprod']);
        });
        Route::get('/list', 'App\Http\Controllers\lafibiovak\RenprodController@list');
        Route::get('/form/{id?}', 'App\Http\Controllers\lafibiovak\RenprodController@form');
        Route::get('/detail/{id}', 'App\Http\Controllers\lafibiovak\RenprodController@detail');
        Route::get('/list-bahan-produksi/{id}', 'App\Http\Controllers\lafibiovak\RenprodController@list_bahan_produksi');
        Route::get('/get-persediaan', 'App\Http\Controllers\lafibiovak\RenprodController@get_persediaan');
        Route::post('/input', 'App\Http\Controllers\lafibiovak\RenprodController@input');
        Route::delete('/{id}', 'App\Http\Controllers\lafibiovak\RenprodController@destroy');
    });
    // Produksi
    Route::prefix('produksi')->group(function () {
        Route::get('/timeline', 'App\Http\Controllers\lafibiovak\ProgressProduksiController@timeline');
        Route::get('/list', 'App\Http\Controllers\lafibiovak\ProgressProduksiController@list');
        Route::get('/list-produk', 'App\Http\Controllers\lafibiovak\ProgressProduksiController@list_produk');
        Route::get('/timeline/{id}', 'App\Http\Controllers\lafibiovak\ProgressProduksiController@edit_timeline');
        Route::post('/input', 'App\Http\Controllers\lafibiovak\ProgressProduksiController@input_timeline');
        Route::post('/update-status', 'App\Http\Controllers\lafibiovak\ProgressProduksiController@update_status');
    });
    // Persediaan Produk Jadi
    Route::prefix('persediaan')->group(function () {
        Route::get('/', function () {
            return view('lafibiovak.manage_produksi.persediaan_produk_jadi.index', ['active_menu' => 'persediaan_produk_jadi']);
        });
        Route::get('/list', 'App\Http\Controllers\lafibiovak\PersediaanController@list');
        Route::get('/detail/{id}', 'App\Http\Controllers\lafibiovak\PersediaanController@detail');
        Route::get('/list-detail/{id}', 'App\Http\Controllers\lafibiovak\PersediaanController@list_detail');
        Route::get('/form/{id}', 'App\Http\Controllers\lafibiovak\PersediaanController@form');
        Route::post('/input', 'App\Http\Controllers\lafibiovak\PersediaanController@input');
        Route::get('/report_masuk', function () {
            return view('lafibiovak.produk_jadi.report_masuk', ['active_menu' => 'report_masuk']);
        });
        Route::get('/report-masuk', 'App\Http\Controllers\lafibiovak\PersediaanController@report_masuk');
    });
    // Distribusi
    Route::prefix('distribusi')->group(function () {
        Route::get('/', function () {
            return view('lafibiovak.distribusi.index', ['active_menu' => 'distribusi']);
        });
        Route::get('/list', 'App\Http\Controllers\lafibiovak\DistribusiController@list');
        Route::get('/get-bets/{id}', 'App\Http\Controllers\lafibiovak\DistribusiController@get_bets');
        Route::get('/form/{id?}', 'App\Http\Controllers\lafibiovak\DistribusiController@form');
        Route::post('/input', 'App\Http\Controllers\lafibiovak\DistribusiController@input');
        Route::delete('/{id}', 'App\Http\Controllers\lafibiovak\DistribusiController@destroy');
        Route::get('/report_keluar', 'App\Http\Controllers\lafibiovak\DistribusiController@report');
        Route::get('/report-keluar', 'App\Http\Controllers\lafibiovak\DistribusiController@report_keluar');
        Route::get('download/{file}', 'App\Http\Controllers\lafibiovak\DistribusiController@viewFile');
    });
});

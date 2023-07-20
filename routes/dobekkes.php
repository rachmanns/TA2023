<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dobekkes\AsetDobekController;

Route::prefix('dobekkes')->name('dobekkes.')->group(function () {
    Route::resource('aset-gudang', AsetDobekController::class);
    Route::get('dashboard', 'App\Http\Controllers\dobekkes\BarangMasukController@dashboard')->name('dashboard_dobekkes');
    Route::get('stok_opname', function () {
        return view('dobekkes.stok_opname.index', ['active_menu' => 'stok_opname']);
    });
    Route::get('aset_gudang', function () {
        return view('dobekkes.aset_gudang.index', ['active_menu' => 'aset_gudang']);
    });
    Route::get('rekap_gudang', function () {
        return view('dobekkes.rekap_gudang.index', ['active_menu' => 'rekap_gudang']);
    });
    Route::get('barang_masuk', function () {
        return view('dobekkes.barang_masuk.index', ['active_menu' => 'barang_masuk']);
    });
    Route::get('daftar_barang_masuk', function () {
        return view('dobekkes.barang_masuk.daftar_barang', ['active_menu' => 'barang_masuk']);
    });
    Route::get('masuk_gudang/{id}', function () {
        return view('dobekkes.barang_masuk.masuk_gudang', ['active_menu' => 'barang_masuk']);
    });
    Route::get('barang_keluar', function () {
        return view('dobekkes.barang_keluar.index', ['active_menu' => 'barang_keluar']);
    });
    Route::get('lihat_barang/{id}', 'App\Http\Controllers\dobekkes\BarangKeluarController@barangKeluar');
    Route::get('data_rp', function () {
        return view('dobekkes.barang_keluar.data_rp', ['active_menu' => 'barang_keluar']);
    });
    Route::get('ada_rp/{id}', 'App\Http\Controllers\dobekkes\BarangKeluarController@rencanaKeluarForm');
    Route::get('tdk_ada_rp', 'App\Http\Controllers\dobekkes\BarangKeluarController@rencanaKeluarForm');
    Route::get('tambah_kontrak', function () {
        return view('dobekkes.barang_keluar.tambah_kontrak', ['active_menu' => 'barang_keluar']);
    });
    Route::prefix('barang-masuk')->name('barang_masuk.')->group(function () {
        Route::get('list-kontrak',  'App\Http\Controllers\dobekkes\BarangMasukController@kontrakList')->name('list_kontrak');
        Route::get('file-kontrak/{type}/{file}',  'App\Http\Controllers\dobekkes\BarangMasukController@kontrakFile');
        Route::get('list-barang/{id}',  'App\Http\Controllers\dobekkes\BarangMasukController@barangList')->name('list_barang');
        Route::post('input-barang-gudang',  'App\Http\Controllers\dobekkes\BarangMasukController@inputBarangGudang')->name('input_barang_gudang');
    });
    Route::prefix('rekap-barang')->name('rekap_barang.')->group(function () {
        Route::get('list-barang-gudang/{id}',  'App\Http\Controllers\dobekkes\BarangMasukController@barangGudangList')->name('list_barang_gudang');
        Route::post('update-exp-date',  'App\Http\Controllers\dobekkes\BarangMasukController@updateExpDate')->name('update_exp_date');
        Route::get('stok-opname', 'App\Http\Controllers\dobekkes\BarangMasukController@stokOpname')->name('stok_opname');
        Route::get('export-stok-opname', 'App\Http\Controllers\dobekkes\BarangMasukController@exportStokOpname')->name('export_stok_opname');
    });
    Route::prefix('barang-keluar')->name('barang_keluar.')->group(function () {
        Route::get('list-keluar',  'App\Http\Controllers\dobekkes\BarangKeluarController@rencanaKeluarList')->name('list_keluar');
        Route::get('file-{type}/{file}',  'App\Http\Controllers\dobekkes\BarangKeluarController@viewFile');
        Route::get('list-rencana',  'App\Http\Controllers\dobekkes\BarangKeluarController@rencanaList')->name('list_rencana');
        Route::get('list-barang-rencana/{id}',  'App\Http\Controllers\dobekkes\BarangKeluarController@barangRencanaList')->name('list_barang_rencana');
        Route::post('input-keluar/{id?}',  'App\Http\Controllers\dobekkes\BarangKeluarController@inputRencanaKeluar')->name('input_keluar');
        Route::get('list-barang/{id?}',  'App\Http\Controllers\dobekkes\BarangKeluarController@barangList')->name('list_barang');
        Route::get('list-barang-keluar/{id}',  'App\Http\Controllers\dobekkes\BarangKeluarController@barangKeluarList')->name('list_barang_keluar');
        Route::post('update-keluar/{id}',  'App\Http\Controllers\dobekkes\BarangKeluarController@updateRencanaKeluar')->name('update_keluar');
        Route::post('update-barang-keluar', 'App\Http\Controllers\dobekkes\BarangKeluarController@updateBarangKeluar');
        Route::delete('hapus-barang-keluar/{id}', 'App\Http\Controllers\dobekkes\BarangKeluarController@hapusBarangKeluar');
    });
    Route::get('/maps_dobekkes', 'App\Http\Controllers\dobekkes\BarangKeluarController@petaLokasiBarangKeluar');
    // Route::get('/grafik_sisa_stok', 'App\Http\Controllers\dobekkes\DashboardController@grafik_sisa_stok');
});

<?php

use App\Http\Controllers\bidum\personil\DashboardPersonilController;
use App\Http\Controllers\bidum\personil\DataPersonilController;
use App\Http\Controllers\bidum\personil\DataTablesPersonilController;
use App\Http\Controllers\bidum\personil\KenkatController;
use App\Http\Controllers\bidum\personil\ModifyPersonilController;
use App\Http\Controllers\bidum\personil\PensiunController;
use App\Http\Controllers\bidum\personil\UkpController;
use Illuminate\Support\Facades\Route;

Route::prefix('bidum')->name('bidum.')->group(function () {
    Route::prefix('personil')->name('personil.')->group(function () {
        Route::get('dashboard', [DashboardPersonilController::class, 'index'])->name('dashboard_personil');

        Route::get('/', [DataPersonilController::class, 'index'])->name('index_data_personil');
        Route::get('/create', [DataPersonilController::class, 'create'])->name('create_data_personil');
        Route::post('/store', [DataPersonilController::class, 'store'])->name('store_data_personil');
        Route::put('/update/{personil}', [DataPersonilController::class, 'update'])->name('update_data_personil');
        Route::get('/show/{id_personil}', [DataPersonilController::class, 'show'])->name('show_data_personil');
        Route::post('/list', [DataPersonilController::class, 'list'])->name('list_data_personil');
        Route::get('/list-korps/{kode_matra}', [DataPersonilController::class, 'list_korps'])->name('list_korps_data_personil');
        Route::get('/list-pangkat/{kode_matra}', [DataPersonilController::class, 'list_pangkat'])->name('list_pangkat_data_personil');
        Route::get('/list-kesatuan/{kode_matra}', [DataPersonilController::class, 'list_kesatuan'])->name('list_kesatuan_data_personil');
        Route::get('/cetak-rh/{personil}', [DataPersonilController::class, 'cetak_data_personil'])->name('cetak_data_personil');
        Route::get('/cetak-nominatif', [DataPersonilController::class, 'cetak_nominatif'])->name('cetak_nominatif');

        Route::post('/store-config', [DataPersonilController::class, 'store_config'])->name('store_config_data_personil');
        Route::post('/update-config/{config}', [DataPersonilController::class, 'update_config'])->name('update_config_data_personil');

        Route::post('/store-pendidikan-umum', [ModifyPersonilController::class, 'store_pendidikan_umum'])->name('store_pendidikan_umum');
        Route::post('/store-keluarga', [ModifyPersonilController::class, 'store_keluarga'])->name('store_keluarga');
        Route::post('/store-pend-militer-pers', [ModifyPersonilController::class, 'store_pend_militer_pers'])->name('store_pend_militer_pers');
        Route::post('/store-riwayat-pangkat', [ModifyPersonilController::class, 'store_riwayat_pangkat'])->name('store_riwayat_pangkat');
        Route::post('/store-riwayat-jabatan', [ModifyPersonilController::class, 'store_riwayat_jabatan'])->name('store_riwayat_jabatan');
        Route::post('/store-penugasan', [ModifyPersonilController::class, 'store_penugasan'])->name('store_penugasan');
        Route::post('/store-bahasa', [ModifyPersonilController::class, 'store_bahasa'])->name('store_bahasa');
        Route::post('/store-tanda-jasa-pers', [ModifyPersonilController::class, 'store_tanda_jasa'])->name('store_tanda_jasa');
        Route::put('/store-pakaian-personil', [ModifyPersonilController::class, 'store_pakaian_personil'])->name('store_pakaian_personil');

        Route::get('/pend-militer-pers/{pend_militer_pers}', [ModifyPersonilController::class, 'get_pend_militer_pers'])->name('get_pend_militer_pers');
        Route::put('/pend-militer-pers/update', [ModifyPersonilController::class, 'update_pend_militer_pers'])->name('update_pend_militer_pers');
        Route::get('/pend-umum-pers/{pend_umum_pers}', [ModifyPersonilController::class, 'get_pend_umum_pers'])->name('get_pend_umum_pers');
        Route::put('/pend-umum-pers/update', [ModifyPersonilController::class, 'update_pend_umum_pers'])->name('update_pend_umum_pers');
        Route::get('/riwayat-pangkat/{riwayat_pangkat}', [ModifyPersonilController::class, 'get_riwayat_pangkat'])->name('get_riwayat_pangkat');
        Route::put('/riwayat-pangkat/update', [ModifyPersonilController::class, 'update_riwayat_pangkat'])->name('update_riwayat_pangkat');
        Route::get('/riwayat-jabatan/{riwayat_jabatan}', [ModifyPersonilController::class, 'get_riwayat_jabatan'])->name('get_riwayat_jabatan');
        Route::put('/riwayat-jabatan/update', [ModifyPersonilController::class, 'update_riwayat_jabatan'])->name('update_riwayat_jabatan');
        Route::get('/keluarga/{keluarga}', [ModifyPersonilController::class, 'get_keluarga'])->name('get_keluarga');
        Route::put('/keluarga/update', [ModifyPersonilController::class, 'update_keluarga'])->name('update_keluarga');
        Route::get('/bahasa/{bahasa}', [ModifyPersonilController::class, 'get_bahasa'])->name('get_bahasa');
        Route::put('/bahasa/update', [ModifyPersonilController::class, 'update_bahasa'])->name('update_bahasa');
        Route::get('/tanda-jasa-pers/{tanda_jasa_pers}', [ModifyPersonilController::class, 'get_tanda_jasa_pers'])->name('get_tanda_jasa_pers');
        Route::put('/tanda-jasa-pers/update', [ModifyPersonilController::class, 'update_tanda_jasa_pers'])->name('update_tanda_jasa_pers');
        Route::get('/penugasan/{penugasan}', [ModifyPersonilController::class, 'get_penugasan'])->name('get_penugasan');
        Route::put('/penugasan/update', [ModifyPersonilController::class, 'update_penugasan'])->name('update_penugasan');

        Route::delete('/delete/keluarga/{id_keluarga}', [ModifyPersonilController::class, 'delete_keluarga'])->name('delete_keluarga');
        Route::delete('/delete/pendidikan-umum/{id_pend_umum_pers}', [ModifyPersonilController::class, 'delete_pendidikan_umum'])->name('delete_pendidikan_umum');
        Route::delete('/delete/pendidikan-militer/{id_pend_militer_pers}', [ModifyPersonilController::class, 'delete_pendidikan_militer'])->name('delete_pendidikan_militer');
        Route::delete('/delete/riwayat-pangkat/{id_riwayat_pangkat}', [ModifyPersonilController::class, 'delete_riwayat_pangkat'])->name('delete_riwayat_pangkat');
        Route::delete('/delete/riwayat-jabatan/{id_riwayat_jabatan}', [ModifyPersonilController::class, 'delete_riwayat_jabatan'])->name('delete_riwayat_jabatan');
        Route::delete('/delete/penugasan/{id_penugasan}', [ModifyPersonilController::class, 'delete_penugasan'])->name('delete_penugasan');
        Route::delete('/delete/bahasa/{id_bahasa}', [ModifyPersonilController::class, 'delete_bahasa'])->name('delete_bahasa');
        Route::delete('/delete/tanda-jasa/{id_jasa_pers}', [ModifyPersonilController::class, 'delete_tanda_jasa'])->name('delete_tanda_jasa');

        Route::get('/list/keluarga/{id_personil}', [DataTablesPersonilController::class, 'list_keluarga'])->name('list_keluarga_data_personil');
        Route::get('/pendidikan-umum/{id_personil}', [DataTablesPersonilController::class, 'list_pendidikan_umum'])->name('list_pendidikan_umum_data_personil');
        Route::get('/pendidikan-militer/{id_personil}', [DataTablesPersonilController::class, 'list_pendidikan_militer'])->name('list_pendidikan_militer_data_personil');
        Route::get('/list/riwayat-pangkat/{id_personil}', [DataTablesPersonilController::class, 'list_riwayat_pangkat'])->name('list_riwayat_pangkat_data_personil');
        Route::get('/list/riwayat-jabatan/{id_personil}', [DataTablesPersonilController::class, 'list_riwayat_jabatan'])->name('list_riwayat_jabatan_data_personil');
        Route::get('/penugasan-dn/{id_personil}', [DataTablesPersonilController::class, 'list_penugasan_dn'])->name('list_penugasan_dn_data_personil');
        Route::get('/penugasan-ln/{id_personil}', [DataTablesPersonilController::class, 'list_penugasan_ln'])->name('list_penugasan_ln_data_personil');
        Route::get('/list/bahasa/{id_personil}', [DataTablesPersonilController::class, 'list_bahasa'])->name('list_bahasa_data_personil');
        Route::get('/tanda_jasa/{id_personil}', [DataTablesPersonilController::class, 'list_tanda_jasa'])->name('list_tanda_jasa_data_personil');
        // Route::get('dashboard/bidang', [DashboardController::class, 'laporan_setiap_bidang'])->name('dashboard_bidang');

        Route::get('/ukp', [UkpController::class, 'index'])->name('index_ukp');
        Route::get('/ukp/generate', [UkpController::class, 'generate'])->name('generate_ukp');
        Route::post('/ukp-list', [UkpController::class, 'list_ukp']);
        Route::get('/ukp/get-personil/{personil}', [UkpController::class, 'get_personil'])->name('get_personil');
        Route::post('/ukp/store', [UkpController::class, 'store'])->name('store_ukp');
        Route::delete('/ukp/{list_ukp}', [UkpController::class, 'destroy']);

        Route::get('/kenkat', [KenkatController::class, 'index'])->name('index_kenkat');
        // Route::get('/ukp/generate', [UkpController::class, 'generate'])->name('generate_ukp');
        Route::get('/kenkat-list/{date}', [KenkatController::class, 'list_kenkat'])->name('list_kenkat');
        Route::get('/kenkat/{list_ukp}', [KenkatController::class, 'get_kenkat'])->name('get_kenkat');
        Route::put('/kenkat/approve', [KenkatController::class, 'approve'])->name('approve_kenkat');
        Route::put('/kenkat/reject', [KenkatController::class, 'reject'])->name('reject_kenkat');

        Route::get('/pensiun', [PensiunController::class, 'index']);
        Route::get('/ulang-tahun/{hbd}', [PensiunController::class, 'index']);
        Route::get('/pensiun/list/{month_year}/{hbd?}', [PensiunController::class, 'list'])->name('list_pensiun');

        Route::put('/nonaktif/{personil}', [DataPersonilController::class, 'nonaktif_personil'])->name('nonaktif_personil');
        Route::put('/aktif/{personil}', [DataPersonilController::class, 'aktif_personil']);
    });
});

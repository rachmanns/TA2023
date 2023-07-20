<?php

use App\Http\Controllers\bangkes\sistoda\RekapRegulasiController;
use App\Http\Controllers\RegulasiController;
use Illuminate\Support\Facades\Route;

Route::prefix('regulasi')->name('regulasi.')->group(function () {
    Route::get('/{kode_bidang}', [RegulasiController::class, 'index']);
    Route::post('/', [RegulasiController::class, 'store']);
    Route::get('/get/{id_bidang}', [RegulasiController::class, 'get']);
    Route::get('/{regulasi}/edit', [RegulasiController::class, 'edit']);
    Route::put('/{regulasi}', [RegulasiController::class, 'update']);
    Route::delete('/{regulasi}', [RegulasiController::class, 'destroy']);
});

Route::prefix('rekap-regulasi')->group(function () {
    Route::get('/', [RekapRegulasiController::class, 'index']);
    Route::get('/get', [RekapRegulasiController::class, 'get']);
});

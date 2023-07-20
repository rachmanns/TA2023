<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBrgMatkesMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_brg_matkes_m', function (Blueprint $table) {
            $table->uuid('id_matkes_matfas')->primary();
            $table->uuid('id_kontrak');
            $table->string('kode_barang');
            $table->string('kategori_barang')->nullable();
            $table->string('nama_matkes');
            $table->unsignedInteger('jumlah');
            $table->double('harga_satuan');
            $table->date('tgl_pendataan');
            $table->string('satuan_brg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_brg_matkes_m');
    }
}

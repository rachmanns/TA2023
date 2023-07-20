<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_produksi', function (Blueprint $table) {
            $table->uuid('id_bahan_produksi')->primary();
            $table->uuid('id_kategori');
            $table->string('nama_bahan_produksi');
            $table->string('satuan')->nullable();
            $table->string('spesifikasi')->nullable();
            $table->integer('kemasan_min')->nullable();
            $table->string('perusahaan')->nullable();
            $table->string('negara')->nullable();
            $table->integer('renada')->nullable();
            $table->integer('jumlah_awal')->nullable();
            $table->integer('stok')->default(0);
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('bahan_produksi');
    }
}

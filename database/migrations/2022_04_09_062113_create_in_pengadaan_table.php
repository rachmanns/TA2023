<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_pengadaan', function (Blueprint $table) {
            $table->uuid('id_in_pengadaan')->primary();
            $table->date('tgl_upload');
            $table->string('kode_kontrak');
            $table->double('nominal');
            $table->string('no_rth');
            $table->string('file_rth');
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
        Schema::dropIfExists('in_pengadaan');
    }
}

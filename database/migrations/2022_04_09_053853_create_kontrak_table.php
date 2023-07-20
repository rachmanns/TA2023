<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak', function (Blueprint $table) {
            $table->uuid('id_kontrak')->primary();
            $table->string('kode_kontrak');
            $table->uuid('id_kegiatan');
            $table->uuid('id_vendor');
            $table->string('nomor_kontak');
            $table->date('tgl_kontrak');
            $table->unsignedInteger('masa_berlaku');
            $table->string('file_kontrak');
            $table->double('nilai_kontrak');
            $table->string('keterangan');
            $table->double('lapju_min');
            $table->double('lapju_sik');
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
        Schema::dropIfExists('kontrak');
    }
}

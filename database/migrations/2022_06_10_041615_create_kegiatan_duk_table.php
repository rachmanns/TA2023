<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_duk', function (Blueprint $table) {
            $table->uuid('id_kegiatan_duk')->primary();
            $table->uuid('id_kat_duk');
            $table->string('judul_kegiatan');
            $table->year('tahun_anggaran');
            $table->string('tempat');
            $table->date('tanggal');
            $table->string('file_kegiatan');
            $table->date('tgl_upload');
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
        Schema::dropIfExists('kegiatan_duk');
    }
}

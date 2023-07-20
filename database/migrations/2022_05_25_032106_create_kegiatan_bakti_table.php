<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanBaktiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_bakti', function (Blueprint $table) {
            $table->uuid('id_bakti')->primary();
            $table->uuid('id_jenis_keg');
            $table->string('nama_kegiatan');
            $table->string('tempat');
            $table->year('periode');
            $table->date('tgl_pelaksanaan');
            $table->string('sasaran');
            $table->string('capaian');
            $table->string('file_laporan');
            $table->uuid('id_keterangan');
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
        Schema::dropIfExists('kegiatan_bakti');
    }
}

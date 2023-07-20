<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanKermaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_kerma', function (Blueprint $table) {
            $table->uuid('id_kerma')->primary();
            $table->string('nama_kegiatan');
            $table->uuid('id_kegiatan');
            $table->uuid('id_jenis_keg');
            $table->string('tempat');
            $table->year('periode');
            $table->date('tgl_pelaksanaan');
            $table->uuid('id_status');
            $table->uuid('id_keterangan');
            $table->string('file_laporan');
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
        Schema::dropIfExists('kegiatan_kerma');
    }
}

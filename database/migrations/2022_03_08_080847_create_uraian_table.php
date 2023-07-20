<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUraianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uraian', function (Blueprint $table) {
            $table->bigIncrements('id_uraian');
            $table->string('nama_uraian');
            $table->string('kode_bidang');
            $table->unsignedBigInteger('pagu_awal');
            $table->unsignedInteger('id_parent'); // kolom untuk relasi ke diri sendiri 
            $table->unsignedInteger('kode_akun');
            $table->unsignedInteger('tahun_anggaran');
            $table->string('kode_dipa');
            $table->unsignedInteger('id_periode');
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
        Schema::dropIfExists('uraian');
    }
}

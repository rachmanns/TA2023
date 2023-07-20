<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBekkesDukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bekkes_duk', function (Blueprint $table) {
            $table->uuid('id_bekkes_duk')->primary();
            $table->year('tahun');
            $table->string('nama');
            $table->unsignedInteger('jumlah');
            $table->string('file_pengajuan');
            $table->string('file_disetujui');
            $table->string('keterangan');
            $table->string('cakupan');
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
        Schema::dropIfExists('bekkes_duk');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi', function (Blueprint $table) {
            $table->bigIncrements('id_realisasi');
            $table->unsignedInteger('id_uraian');
            $table->unsignedInteger('id_periode');
            $table->string('tgl_realisasi');
            $table->unsignedBigInteger('jumlah');
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
        Schema::dropIfExists('realisasi');
    }
}

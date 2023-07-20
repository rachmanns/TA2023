<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisiPaguTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisi_pagu', function (Blueprint $table) {
            $table->bigIncrements('id_revisi');
            $table->unsignedInteger('id_uraian');
            $table->unsignedBigInteger('tambah');
            $table->unsignedBigInteger('kurang');
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
        Schema::dropIfExists('revisi_pagu');
    }
}

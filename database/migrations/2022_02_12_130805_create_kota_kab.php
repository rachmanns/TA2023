<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKotaKab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kota_kab', function (Blueprint $table) {
            $table->id('id_kotakab');
            $table->string('nama_kotakab');
            $table->string('jenis');
            $table->unsignedBigInteger('id_provinsi');
            $table->foreign('id_provinsi')->references('id_provinsi')->on('provinsi');
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
        Schema::dropIfExists('kota_kab');
    }
}

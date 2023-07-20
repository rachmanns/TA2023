<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaskesParamedis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faskes_paramedis', function (Blueprint $table) {
            $table->uuid('id_paramedis')->primary();
            $table->string('nama_paramedis');
            $table->uuid('id_jenis_paramedis');
            $table->string('matra')->nullable();
            $table->string('jenis_ijazah');
            $table->string('jenjang');
            $table->string('no_identitas');
            $table->string('satuan_asal')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('jabatan_struktural');
            $table->string('jabatan_fungsional');
            $table->string('keterangan');
            $table->string('klasifikasi');
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
        Schema::dropIfExists('faskes_paramedis');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaskesNakes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faskes_nakes', function (Blueprint $table) {
            $table->uuid('id_dokter')->primary();
            $table->string('nama_dokter');
            $table->string('keterangan');
            $table->string('klasifikasi');
            $table->string('matra')->nullable();
            $table->uuid('id_spesialis');
            $table->string('pangkat_korps')->nullable();
            $table->string('no_identitas');
            $table->string('satuan_asal')->nullable();
            $table->string('jabatan_struktural');
            $table->string('jabatan_fungsional');
            $table->string('jenjang', 5);
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
        Schema::dropIfExists('faskes_nakes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaBangkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_bangkes', function (Blueprint $table) {
            $table->uuid('id_peserta_bangkes')->primary();
            $table->uuid('id_pelatihan_bangkes');
            $table->string('nama');
            $table->string('matra');
            $table->string('pangkat_korps');
            $table->string('nrp');
            $table->string('satuan');
            $table->string('keterangan');
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
        Schema::dropIfExists('peserta_bangkes');
    }
}

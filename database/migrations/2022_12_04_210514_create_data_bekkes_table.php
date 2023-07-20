<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBekkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_bekkes', function (Blueprint $table) {
            $table->uuid('id_data_bekkes')->primary();
            $table->uuid('id_mas_bek');
            $table->foreign('id_mas_bek')->references('id_mas_bek')->on('master_bekkes')->onDelete('cascade')->onUpdate('cascade');
            $table->year('tahun_anggaran');
            $table->string('jenis_tujuan');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('data_bekkes');
    }
}

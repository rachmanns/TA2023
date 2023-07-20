<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetilBahanRenprodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_bahan_renprod', function (Blueprint $table) {
            $table->uuid('id_detil_bahan')->primary();
            $table->uuid('id_renprod');
            $table->uuid('id_bahan_produksi');
            $table->string('id_pelaksana');
            $table->integer('jumlah');
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
        Schema::dropIfExists('detil_bahan_renprod');
    }
}

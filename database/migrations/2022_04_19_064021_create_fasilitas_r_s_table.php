<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasRSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas_rs', function (Blueprint $table) {
            $table->uuid('id_fasilitas_rs')->primary();
            $table->unsignedInteger('id_rs');
            $table->uuid('id_fasilitas');
            $table->integer('jumlah');
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
        Schema::dropIfExists('fasilitas_rs');
    }
}

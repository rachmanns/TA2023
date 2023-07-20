<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasanPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasan_pos', function (Blueprint $table) {
            $table->uuid('id_penugasan_pos')->primary();
            $table->uuid('id_tugas');
            $table->uuid('id_pos');
            $table->string('nama_ketua')->nullable();
            $table->string('no_telp')->nullable();
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
        Schema::dropIfExists('penugasan_pos');
    }
}

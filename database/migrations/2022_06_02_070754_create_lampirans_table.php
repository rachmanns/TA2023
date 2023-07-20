<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLampiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lampiran', function (Blueprint $table) {
            $table->uuid('id_lampiran')->primary();
            $table->uuid('id_kontrak');
            $table->string('file_doc');
            $table->string('nama_file');
            $table->string('no_file');
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
        Schema::dropIfExists('lampiran');
    }
}

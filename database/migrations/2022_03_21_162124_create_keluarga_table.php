<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga', function (Blueprint $table) {
            $table->uuid('id_keluarga')->primary();
            $table->uuid('id_personil');
            $table->string('no_surat_nikah');
            $table->string('no_kk');
            $table->string('no_bpjs');
            $table->string('no_kpis');
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
        Schema::dropIfExists('keluarga');
    }
}

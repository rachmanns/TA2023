<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendUmumPersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pend_umum_pers', function (Blueprint $table) {
            $table->uuid('id_pend_umum_pers')->primary();
            $table->uuid('id_personil');
            $table->uuid('id_pend_umum');
            $table->string('nama_sekolah');
            $table->year('tahun_lulus');
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
        Schema::dropIfExists('pend_umum_pers');
    }
}

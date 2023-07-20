<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_jabatan', function (Blueprint $table) {
            $table->uuid('id_riwayat_jabatan')->primary();
            $table->uuid('id_personil');
            $table->date('tmt_jabatan');
            $table->string('no_skep_jabatan');
            $table->date('tgl_skep_jabatan');
            $table->string('no_sprin_jabatan');
            $table->date('tgl_sprin_jabatan');
            $table->uuid('id_jabatan');
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
        Schema::dropIfExists('riwayat_jabatan');
    }
}
